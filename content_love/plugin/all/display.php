<?php
$all_plugin = \lib\app\plugin\get::all_list_by_count();

if(!is_array($all_plugin))
{
	$all_plugin = [];
}

?>

<div class="tblBox font-14">
	<table class="tbl1 v1">
		<thead>
			<tr>
				<th><?php echo T_("Code") ?></th>
				<th><?php echo T_("Title") ?></th>
				<th class="collapsing"><?php echo T_("Price") ?></th>
				<th class="collapsing"><?php echo T_("Count enable") ?></th>
				<th class="collapsing"><?php echo T_("Count") ?></th>
				<th class="collapsing"><?php echo T_("List") ?></th>
			</tr>
		</thead>
		<tbody>

		<?php foreach ($all_plugin as $key => $value) {?>
			<tr>
				<td><code><?php echo a($value, 'plugin') ?></code></td>
				<td><?php echo a($value, 'title') ?></td>
				<td class="collapsing"><?php echo \dash\fit::number(a($value, 'price')) ?></td>
				<td class="collapsing"><span class="fc-green txtB"><?php echo \dash\fit::number(a($value, 'count_enable')) ?></span></td>
				<td class="collapsing"><?php echo \dash\fit::number(a($value, 'count_use')) ?></td>
				<td class="collapsing"><a href="#" class="btn info outline"><?php echo T_("Business") ?></a></td>

			</tr>
		<?php } //endfor ?>

		</tbody>
	</table>
</div>