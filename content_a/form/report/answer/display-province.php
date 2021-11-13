
    <div id="chartdivmap" class="box chart x600 notActive" data-abc='a/form_map'></div>

<?php if(a($myData, 'data_table')) {?>
<div class="tblBox font-14">
	<table class="tbl1 v6 minimal">
		<thead class="text-xs">
			<tr>
				<th><?php echo T_("Choice") ?></th>
				<th class="collapsing text-left"><?php echo T_("Frequency") ?></th>
				<th class="collapsing text-left"><?php echo T_("Percent frequency") ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($myData['data_table'] as $key => $value) {?>
				<tr>
					<td><?php echo a($value, 'name') ?></td>
					<td class="ltr text-left collapsing"><?php echo \dash\fit::number(a($value, 'count')) ?></td>
					<td class="ltr text-left collapsing"><?php echo T_("%"); ?> <b><?php echo \dash\fit::text(a($value, 'percent')); ?></b></td>
				</tr>
			<?php } //endfor ?>
		</tbody>
		<tfoot>
			<tr>
				<td><?php echo T_("Sum") ?></td>
				<td class="ltr text-left"><?php echo \dash\fit::number(array_sum(array_column($myData['data_table'], 'count'))) ?></td>
				<td class="ltr text-left"><?php echo T_("%"); ?> <b><?php echo \dash\fit::text(array_sum(array_column($myData['data_table'], 'percent'))); ?></b></td>
			</tr>
		</tfoot>
	</table>
</div>
<?php } //endif ?>



<div class="hide">

  <div id="charttitle"><?php echo T_("Answer"); ?></div>
  <div id="chartitemtitle"></div>
  <div id="chartdata"><?php echo \dash\data::reportDetail_chart(); ?></div>
</div>
