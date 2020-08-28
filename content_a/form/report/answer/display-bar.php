
    <div id="chartdivbar" class="box chart notActive x400" data-abc='a/form_charts'></div>

<?php if(\dash\get::index($myData, 'data_table')) {?>
<div class="tblBox font-14">
	<table class="tbl1 v6 minimal">
		<thead class="font-10">
			<tr>
				<th><?php echo T_("Choice") ?></th>
				<th class="collapsing txtL"><?php echo T_("Frequency") ?></th>
				<th class="collapsing txtL"><?php echo T_("Percent frequency") ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($myData['data_table'] as $key => $value) {?>
				<tr>
					<td><?php echo \dash\get::index($value, 'name') ?></td>
					<td class="ltr txtL collapsing"><?php echo \dash\fit::number(\dash\get::index($value, 'count')) ?></td>
					<td class="ltr txtL collapsing"><?php echo T_("%"); ?> <b><?php echo \dash\fit::text(\dash\get::index($value, 'percent')); ?></b></td>
				</tr>
			<?php } //endfor ?>
		</tbody>
		<tfoot>
			<tr>
				<td><?php echo T_("Sum") ?></td>
				<td class="ltr txtL"><?php echo \dash\fit::number(array_sum(array_column($myData['data_table'], 'count'))) ?></td>
				<td class="ltr txtL"><?php echo T_("%"); ?> <b><?php echo \dash\fit::text(array_sum(array_column($myData['data_table'], 'percent'))); ?></b></td>
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
