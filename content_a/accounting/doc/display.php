<?php require_once(root. 'content_a/accounting/filter.php'); ?>

	<?php if(\dash\data::dataTable()) {?>
		<table class="tbl1 v6  minimal font-12">
			<thead>
				<tr>
					<th><?php echo T_("Number") ?></th>
					<th><?php echo T_("Date") ?></th>
					<th><?php echo T_("Status") ?></th>
					<th><?php echo T_("Item count") ?></th>
					<th><?php echo T_("Total debtor") ?></th>
					<th><?php echo T_("Total creditor") ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach (\dash\data::dataTable() as $key => $value) {?>
					<tr class="font-12">
						<td class="font-14">
							<a class="link" href="<?php echo \dash\url::that(). '/edit?id='. \dash\get::index($value, 'id'); ?>">#<?php echo \dash\fit::number(\dash\get::index($value, 'number'), true, 'en'); ?></a>
						</td>
						<td class="txtB"><?php echo \dash\fit::date(\dash\get::index($value, 'date')) ?></td>
						<td class=""><?php if(\dash\get::index($value, 'status') === 'lock') { echo '<i class="compact sf-lock fc-green mRa10"></i>';} else { echo '<i class="compact sf-unlock fc-red mRa10"></i>';}  ?><?php echo T_(\dash\get::index($value, 'tstatus')) ?></td>
						<td class=""><?php echo \dash\fit::number(\dash\get::index($value, 'item_count')) ?></td>

						<td class="font-14 fc-red"><span class="txtR txtB"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'sum_debtor'), 'en') ?></span></td>
						<td class="font-14 fc-green"><span class="txtR txtB"><?php echo \dash\fit::number_decimal(\dash\get::index($value, 'sum_creditor'), 'en') ?></span></td>
					</tr>
					<tr>
						<td class="pTB5-f" colspan="7"><?php echo \dash\get::index($value, 'desc') ?></td>
					</tr>
				<?php } //endif ?>
			</tbody>
		</table>
		<?php \dash\utility\pagination::html(); ?>
	<?php }else{ ?>
		<div class="msg success2"><?php echo T_("Hi!") ?> <a class="btn link" href="<?php echo \dash\url::that() ?>/add"><?php echo T_("Add new") ?></a></div>
	<?php } //endif ?>
