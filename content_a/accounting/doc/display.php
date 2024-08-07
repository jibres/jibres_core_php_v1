<?php require_once(root. 'content_a/accounting/filter.php'); ?>
<form method="post" id="formreset">
	<input type="hidden" name="resetnumber" value="resetnumber">
	<input type="hidden" name="year_id" value="<?php echo \dash\data::myYearId() ?>">
</form>

	<?php if(\dash\data::dataTable()) {?>
		<div class="tblBox">
			<table class="tbl1 v6  minimal text-sm">
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
						<tr class="text-sm">
							<td class="font-14">
								<a class="link-primary" href="<?php echo \dash\url::that(). '/edit?id='. a($value, 'id'); ?>">#<?php echo \dash\fit::number(a($value, 'number'), true, 'en'); ?></a>
							</td>
							<td class="font-bold"><a href="<?php echo \dash\url::that(). \dash\request::full_get(['startdate' => \dash\fit::date_en(a($value, 'date')), 'enddate' => \dash\fit::date_en(a($value, 'date'))]) ?>"><?php echo \dash\fit::date(a($value, 'date')) ?></a></td>
							<td class="">
								<?php if(a($value, 'status') === 'lock') { echo '<i class="inline-block sf-lock text-red-800 mRa10"></i>';} else { echo '<i class="inline-block sf-unlock text-green-700 mRa10"></i>';}  ?>
								<a href="<?php echo \dash\url::that(). '?status='. a($value, 'status'); ?>"><?php echo T_(a($value, 'tstatus')) ?></a>
								<?php if(a($value, 'type') === 'opening') { echo '<i class="text-gray-400 font-bold">'. T_("Opening Document"). '</i>';} ?>
							</td>
							<td class=""><?php echo \dash\fit::number(a($value, 'item_count')) ?></td>

							<td class="font-14 text-green-700"><span class="text-right font-bold"><?php echo \dash\fit::number_decimal(a($value, 'sum_debtor'), 'en') ?></span></td>
							<td class="font-14 text-red-800"><span class="text-right font-bold"><?php echo \dash\fit::number_decimal(a($value, 'sum_creditor'), 'en') ?></span></td>
						</tr>
						<tr>
							<td class="pTB5-f" colspan="7"><?php if(a($value, 'gallery')) { echo '<i class="inline-block mRa10 sf-attach"></i>';} ?><?php echo a($value, 'desc') ?></td>
						</tr>
					<?php } //endif ?>
				</tbody>
			</table>
		</div>
		<?php \dash\utility\pagination::html(); ?>
	<?php }else{ ?>
		<div class="alert-success"><?php echo T_("Hi!") ?> <a class="btn-link" href="<?php echo \dash\url::that() ?>/add"><?php echo T_("Add new") ?></a></div>
	<?php } //endif ?>
