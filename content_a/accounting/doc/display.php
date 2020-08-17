<div class="avand">
	<?php if(\dash\data::dataTable()) {?>
		<table class="tbl1 v1 fs12">
			<thead>
				<tr>
					<th class="collapsing"><?php echo T_("Date") ?></th>
					<th class="collapsing"><?php echo T_("Number") ?></th>

					<th><?php echo T_("Description") ?></th>
					<th><?php echo T_("Total debtor") ?></th>
					<th><?php echo T_("Total creditor") ?></th>
					<th><?php echo T_("Item count") ?></th>
					<th><?php echo T_("Status") ?></th>
					<th class="collapsing"><?php echo T_("Edit") ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::dataTable() as $key => $value) {?>
					<tr>
						<td class="collapsing"><?php echo \dash\fit::date(\dash\get::index($value, 'date')) ?></td>
						<td class="collapsing"><?php echo \dash\fit::number(\dash\get::index($value, 'number')) ?></td>

						<td><?php echo \dash\get::index($value, 'desc') ?></td>
						<td class="collapsing"><span class="txtR txtB"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'sum_debtor'), 'en') ?></span></td>
						<td class="collapsing"><span class="txtR txtB"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'sum_creditor'), 'en') ?></span></td>
						<td class="collapsing"><?php echo \dash\fit::number(\dash\get::index($value, 'item_count')) ?></td>
						<td class="collapsing"><?php echo T_(\dash\get::index($value, 'status')) ?></td>
						<td class="collapsing"><a class="btn link" href="<?php echo \dash\url::that(). '/edit?id='. \dash\get::index($value, 'id'); ?>"><?php echo T_("Edit") ?></a></td>
					</tr>
				<?php } //endif ?>
			</tbody>
		</table>
		<?php \dash\utility\pagination::html(); ?>
	<?php }else{ ?>
		<div class="msg fs14 success2"><?php echo T_("Hi!") ?> <a class="btn link" href="<?php echo \dash\url::that() ?>/add"><?php echo T_("Add new") ?></a></div>
	<?php } //endif ?>
</div>