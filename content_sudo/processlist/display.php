<div class="cbox">
	<div class="tblBox">
		<table class="tbl1 v3">
			<thead>
				<tr>
					<th class="collapsing">Id</th>
					<th class="collapsing">User</th>
					<th class="collapsing">Host</th>
					<th class="collapsing">db</th>
					<th class="collapsing">Command</th>
					<th class="collapsing">Time</th>
					<th class="collapsing">State</th>
					<th>Info</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::processlist() as $key => $value) {?>
					<tr>
						<td class="collapsing"><?php echo a($value, 'Id') ?></td>
						<td class="collapsing"><?php echo a($value, 'User') ?></td>
						<td class="collapsing"><?php echo a($value, 'Host') ?></td>
						<td class="collapsing"><?php echo a($value, 'db') ?></td>
						<td class="collapsing"><?php echo a($value, 'Command') ?></td>
						<td class="collapsing"><?php echo a($value, 'Time') ?></td>
						<td class="collapsing"><?php echo a($value, 'State') ?></td>
						<td><?php echo a($value, 'Info') ?></td>
					</tr>
				<?php } //endfor ?>
			</tbody>
		</table>
	</div>
<pre><?php print_r(\dash\data::fullprocesslist()); ?></pre>
</div>