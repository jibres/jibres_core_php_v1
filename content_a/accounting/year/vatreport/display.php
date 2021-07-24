
<?php foreach (\dash\data::dataTable() as $key => $value) { ?>
	<div class="tblBox">
		<table class="tbl1 v4">
			<thead>
				<tr>
					<th><?php echo T_("Qurarter") ?></th>
					<th><?php echo T_("Start date") ?></th>
					<th><?php echo T_("End date") ?></th>
					<th><?php echo T_("Count") ?></th>
					<th><?php echo T_("Total") ?></th>
					<th><?php echo T_("Total discount") ?></th>
					<th><?php echo T_("Total vat") ?></th>
					<th><?php echo T_("Total include vat") ?></th>
					<th><?php echo T_("Total nob-include vat") ?></th>
					<th><?php echo T_("Vat") ?></th>
					<th><?php echo T_("Tax") ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo a($value, 'quarter') ?></td>
					<td><?php echo a($value, 'startdate') ?></td>
					<td><?php echo a($value, 'enddate') ?></td>
					<td><?php echo a($value, 'count') ?></td>
					<td><?php echo a($value, 'total') ?></td>
					<td><?php echo a($value, 'totalvat') ?></td>
					<td><?php echo a($value, 'totaldiscount') ?></td>
					<td><?php echo a($value, 'totalincludevat') ?></td>
					<td><?php echo a($value, 'totalnotincludevat') ?></td>
					<td><?php echo a($value, 'totalvat6') ?></td>
					<td><?php echo a($value, 'totalvat3') ?></td>
				</tr>
			</tbody>
		</table>
	</div>
<?php } //endif ?>
