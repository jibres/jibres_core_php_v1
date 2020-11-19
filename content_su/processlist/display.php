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
						<td class="collapsing"><?php echo \dash\get::index($value, 'Id') ?></td>
						<td class="collapsing"><?php echo \dash\get::index($value, 'User') ?></td>
						<td class="collapsing"><?php echo \dash\get::index($value, 'Host') ?></td>
						<td class="collapsing"><?php echo \dash\get::index($value, 'db') ?></td>
						<td class="collapsing"><?php echo \dash\get::index($value, 'Command') ?></td>
						<td class="collapsing"><?php echo \dash\get::index($value, 'Time') ?></td>
						<td class="collapsing"><?php echo \dash\get::index($value, 'State') ?></td>
						<td><?php echo \dash\get::index($value, 'Info') ?></td>
					</tr>
				<?php } //endfor ?>
			</tbody>
		</table>
	</div>
<pre><?php print_r(\dash\data::fullprocesslist()); ?></pre>
</div>