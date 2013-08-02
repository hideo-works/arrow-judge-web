<?php
/**
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
 * @package       Cake.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Debugger', 'Utility');
?>
<<<<<<< HEAD
=======
<h1>Problem</h1>
>>>>>>> 49a3a9e2c2db6c5c6fe448a15c2fc59b13f88d31
<div class="append">
	<i class="icon-plus-sign"></i>
	<?php echo $this->Html->link('Add new problem', 'create'); ?>
</div>
<?php if(count($privates) > 0): ?>
<<<<<<< HEAD
<h1>Private Problems</h1>
=======
<h2>Private Problems</h2>
>>>>>>> 49a3a9e2c2db6c5c6fe448a15c2fc59b13f88d31
<table class="table table-striped">
	<thead>
		<tr>
			<th>Problem ID</th>
			<th>Problem Name</th>
			<th>CPU Limit</th>
			<th>Memory Limit</th>
			<th>Author</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($privates as $private): ?>
		<tr>
			<td><?php echo h($private['Problem']['id']); ?></td>
			<td><?php echo $this->Html->link($private['Problem']['name'], 'view/'.$private['Problem']['id']); ?></td>
			<td><?php echo h($private['Problem']['cpu']); ?> sec</td>
			<td><?php echo h($private['Problem']['memory']); ?> MB</td>
			<td><?php echo $this->Html->link($private['User']['username'], '/users/index/'.$private['User']['id']); ?></td>
			<?php if($private['Problem']['user_id'] == $userid): ?>
			<td><?php echo $this->Html->link('Setting =>', 'setting/'.$private['Problem']['id']); ?></td>
			<td><?php echo $this->Html->link('Delete =>', 'delete/'.$private['Problem']['id']); ?></td>
			<?php else: ?>
			<td></td>
			<td></td>
			<?php endif; ?>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<<<<<<< HEAD
<h1>Public Problems</h1>
<?php else: ?>
<h1>Problems</h1>
=======
<h2>Public Problems</h2>
>>>>>>> 49a3a9e2c2db6c5c6fe448a15c2fc59b13f88d31
<?php endif; ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Problem ID</th>
			<th>Problem Name</th>
			<th>CPU Limit</th>
			<th>Memory Limit</th>
			<th>Author</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($publics as $public): ?>
		<tr>
			<td><?php echo h($public['Problem']['id']); ?></td>
			<td><?php echo $this->Html->link($public['Problem']['name'], 'view/'.$public['Problem']['id']); ?></td>
			<td><?php echo h($public['Problem']['cpu']); ?> sec</td>
			<td><?php echo h($public['Problem']['memory']); ?> MB</td>
			<td><?php echo $this->Html->link($public['User']['username'], '/users/index/'.$public['User']['id']); ?></td>
			<?php if($public['Problem']['user_id'] == $userid): ?>
			<td><?php echo $this->Html->link('Setting =>', 'setting/'.$public['Problem']['id']); ?></td>
			<td><?php echo $this->Html->link('Delete =>', 'delete/'.$public['Problem']['id']); ?></td>
			<?php else: ?>
			<td></td>
			<td></td>
			<?php endif; ?>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
