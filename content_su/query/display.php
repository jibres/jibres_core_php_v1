<div class="cbox">
	<div class="tblBox">
		<table class="tbl1 v1 ltr">
			<thead>
				<tr>
					<th class="txtL">Variable_name</th>
					<th class="txtL">Value</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::mysqlConf() as $key => $value) { if(a($value, 'Variable_name') == 'ft_boolean_syntax') {continue;}?>
					<tr class="txtL">
						<td class="txtL"><?php echo a($value, 'Variable_name') ?></td>
						<td class="txtL"><?php echo a($value, 'Value') ?></td>
					</tr>
				<?php } //endfor ?>
			</tbody>
		</table>
	</div>
</div>
<pre>
<?php print_r(\dash\data::showDatabases()) ?>
</pre>

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