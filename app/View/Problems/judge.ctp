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
$syntax = json_decode($syntax, true);
$status = json_decode($status, true);
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Problem ID</th>
			<th>Language</th>
			<th>CPU Limit</th>
			<th>Stack Limit</th>
			<th>Memory Limit</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo h(sprintf('#%d: %s', $problem['Problem']['id'], $problem['Problem']['name'])); ?></td>
			<td><?php echo h($problem['Language']['name']); ?></td>
			<td><?php echo h($problem['Problem']['cpu']); ?> sec</td>
			<td><?php echo h($problem['Problem']['stack']); ?> MB</td>
			<td><?php echo h($problem['Problem']['memory']); ?> MB</td>
			<td><?php echo h($status[$problem['Problem']['status']]); ?></td>
		</tr>
	</tbody>
</table>
<textarea id="source" rows="<?php echo substr_count($problem['Problem']['source'], "\n") + 1; ?>" readonly="readonly"><?php echo h($problem['Problem']['source']); ?></textarea>
<script type="text/javascript">
	editAreaLoader.init({
		id: 'source',
		is_editable: false,
		start_highlight: true,
		syntax: "<?php echo h($syntax[$problem['Language']['name']]); ?>"
	});
	setInterval('location.reload()', 5000);
</script>
