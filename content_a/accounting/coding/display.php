<div class="avand">
	<table class="tbl1 v1">
		<thead>
			<tr>

				<th><?php echo T_("code") ?></th>
				<th><?php echo T_("title") ?></th>
				<th><?php echo T_("status") ?></th>
				<th><?php echo T_("nature") ?></th>
				<th><?php echo T_("detailable") ?></th>
				<th><?php echo T_("type") ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach (\dash\data::dataTable() as $key => $value) {?>
				<tr>
					<td><?php echo \dash\get::index($value, 'code') ?></td>
					<td><?php echo \dash\get::index($value, 'title') ?></td>
					<td><?php echo \dash\get::index($value, 'status') ?></td>
					<td><?php echo \dash\get::index($value, 'nature') ?></td>
					<td><?php echo \dash\get::index($value, 'detailable') ?></td>
					<td><?php echo \dash\get::index($value, 'type') ?></td>
				</tr>
			<?php } //endif ?>
		</tbody>
	</table>
</div>