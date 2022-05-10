<div class="box p-4">
	<div class="tblBox">
		<table class="tbl1 v1 ltr">
			<thead>
				<tr>
					<th class="text-left">Variable_name</th>
					<th class="text-left">Value</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::mysqlConf() as $key => $value) { if(a($value, 'Variable_name') == 'ft_boolean_syntax') {continue;}?>
					<tr class="text-left">
						<td class="text-left"><?php echo a($value, 'Variable_name') ?></td>
						<td class="text-left"><?php echo a($value, 'Value') ?></td>
					</tr>
				<?php } //endfor ?>
			</tbody>
		</table>
	</div>
</div>
<pre>
<?php print_r(\dash\data::allConnection()); ?>
</pre>
<pre>
<?php print_r(\dash\data::showDatabases()) ?>
</pre>

<div class="box p-4">
	<div class="tblBox">
		<table class="tbl1 v3 ltr">
			<thead>
				<tr>
					<th class="text-left">IP</th>
					<th class="text-left">Count</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::ipList() as $key => $value) {?>
					<tr class="text-left">
						<td class="text-left"><?php echo a($value, 'ip') ?></td>
						<td class="text-left"><?php echo a($value, 'count') ?></td>
					</tr>
				<?php } //endfor ?>
			</tbody>
		</table>
	</div>
</div>