<?php
App::uses('AppModel', 'Model');

class Language extends AppModel {
	public $name = 'Language';

	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Must not be empty',
			),
		),
		'detail' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Must not be empty',
			),
		),
		'extension' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Must not be empty',
			),
		),
		'coloring' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Must not be empty',
			),
		),
		'execute' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Must not be empty',
			),
		),
	);
}
