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
			<?php foreach ($myData['data_table'] as $key => $value) { ?>
				<tr>

					<td><a class="link-primary" href="<?php echo \dash\url::this(). '/answer'. \dash\request::full_get(['iid' => null, 'item' => \dash\request::get('iid'), 'answer' => a($value, 'answer')]); ?>"><?php if(a($value, 'name')) { echo a($value, 'name'); }else{ echo '-'; } ?></a></td>
					<td class="ltr text-left collapsing"><?php echo \dash\fit::number(a($value, 'count')) ?></td>
					<td class="ltr text-left collapsing"><?php echo T_("%"); ?> <b><?php echo \dash\fit::text(a($value, 'percent')); ?></b></td>
				</tr>
			<?php } //endfor ?>
		</tbody>
		<?php if(\dash\data::itemDetail_type() === 'multiple_choice') {}else{?>
		<tfoot>
			<tr>
				<td><?php echo T_("Sum") ?></td>
				<td class="ltr text-left"><?php echo \dash\fit::number(array_sum(array_column($myData['data_table'], 'count'))) ?></td>
				<td class="ltr text-left"><?php echo T_("%"); ?> <b><?php echo \dash\fit::text(array_sum(array_column($myData['data_table'], 'percent'))); ?></b></td>
			</tr>
		</tfoot>
	<?php } //endif ?>
	</table>
</div>

<?php } //endif ?>
