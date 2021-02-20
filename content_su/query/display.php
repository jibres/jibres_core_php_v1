<div class="cbox">
	<div class="tblBox">
		<table class="tbl1 v3 ltr">
			<thead>
				<tr>
					<th class="txtL">IP</th>
					<th class="txtL">Count</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::ipList() as $key => $value) {?>
					<tr class="txtL">
						<td class="txtL"><?php echo a($value, 'ip') ?></td>
						<td class="txtL"><?php echo a($value, 'count') ?></td>
					</tr>
				<?php } //endfor ?>
			</tbody>
		</table>
	</div>
</div>