<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

class ContestsController extends AppController {
	public $name = 'Contests';
	public $helpers = array('Form');
	public $uses = array('Contest', 'User', 'Registration');
	public $components = array('Session');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('*');
		$this->Auth->allow('index', 'problem', 'standings');
		$this->Auth->flash['element'] = 'error';
	}

	public function index() {
		$contests = $this->Contest->find('all', array('conditions' => array('OR' => array('Contest.public' => 1, 'AND' => array('Contest.public' => 0, 'Contest.user_id' => $this->Auth->user('id')))), 'order' => 'Contest.created DESC'));
		$this->set('contests', $contests);
	}

	public function create() {
		if(!empty($this->request->data)) {
			$admin = $this->User->find('first', array('conditions' => array('User.username' => $this->request->data['Contest']['admin'])));
			if($admin) {
				$this->request->data['Contest']['user_id'] = $admin['User']['id'];
				$this->request->data['Contest']['public'] = 0;

				$this->request->data['Contest']['start'] = $this->Contest->deconstruct('Contest.start', $this->request->data['Contest']['start']);
				$this->request->data['Contest']['end'] = $this->Contest->deconstruct('Contest.end', $this->request->data['Contest']['end']);

				if($this->Contest->save($this->request->data)) {
					$this->redirect('index');
				}
			} else {
				$this->Contest->invalidate('admin', 'User not found');
			}
		}
	}

	public function setting($id = null) {
		if(!$id) {
			$this->redirect('/');
		}

		$contest = $this->Contest->findById($id);
		if(!$contest) {
			$this->redirect('/');
		}
		if($contest['Contest']['user_id'] != $this->Auth->user('id')) {
			$this->redirect('/');
		}

		if($this->request->data) {
			$this->request->data['Contest']['id'] = $id;

			if($contest['Contest']['public'] == 1) {
				$this->request->data['Contest']['public'] = 1;
			}

			$this->request->data['Contest']['start'] = $this->Contest->deconstruct('Contest.start', $this->request->data['Contest']['start']);
			$this->request->data['Contest']['end'] = $this->Contest->deconstruct('Contest.end', $this->request->data['Contest']['end']);

			if($this->Contest->save($this->request->data)) {
				$this->redirect('index');
			}
		} else {
			$this->request->data = $contest;
		}
		$this->set('contest', $contest);
	}

	public function register($id = null) {
		if(!$id) {
			$this->redirect('/');
		}

		$contest = $this->Contest->findById($id);
		if(!$contest) {
			$this->redirect('/');
		}
		if($contest['Contest']['user_id'] == $this->Auth->user('id')) {
			$this->redirect('/');
		}
		if($contest['Contest']['public'] == 0) {
			$this->redirect('/');
		}

		if(strtotime($contest['Contest']['start']) > time()) {
			$register = $this->Registration->find('first', array('conditions' => array('AND' => array('Registration.contest_id' => $id, 'Registration.user_id' => $this->Auth->user('id')))));
			if($register) {
				$this->Session->setFlash('You have already registered', 'error');
			} else {
				if($this->request->data) {
					$register = array();
					$register['Registration']['contest_id'] = $id;
					$register['Registration']['user_id'] = $this->Auth->user('id');
					$register['Registration']['score'] = json_encode(array_fill(0, count($contest['Problem']), ''));
	
					if($this->Registration->save($register)) {
						$this->redirect('index/'.$id);
					}
				}
			}
		} else {
			$this->Session->setFlash('Contest has already started, you can not register', 'error');
		}

		$this->set('contest', $contest);
	}

	public function problem($id = null) {
		if(!$id) {
			$this->redirect('/');
		}

		$contest = $this->Contest->findById($id);
		if(!$contest) {
			$this->redirect('/');
		}
		if($contest['Contest']['user_id'] != $this->Auth->user('id') && $contest['Contest']['public'] == 0) {
			$this->redirect('/');
		}

		$this->set('contest', $contest);
	}

	public function standings($id = null) {
		if(!$id) {
			$this->redirect('/');
		}

		$contest = $this->Contest->findById($id);
		if(!$contest) {
			$this->redirect('/');
		}
		if($contest['Contest']['user_id'] != $this->Auth->user('id') && $contest['Contest']['public'] == 0) {
			$this->redirect('/');
		}
		$this->set('contest', $contest);

		$registration = $this->Registration->find('all', array('conditions' => array('Registration.contest_id' => $id)));
		$this->set('registration', $registration);
	}
}
