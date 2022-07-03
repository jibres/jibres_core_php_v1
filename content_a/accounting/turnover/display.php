<form method="post" id="formreset">
	<input type="hidden" name="resetnumber" value="resetnumber">
	<input type="hidden" name="year_id" value="<?php echo \dash\data::myYearId() ?>">
</form>

<form method="get" autocomplete="off" action="<?php echo \dash\url::current() ?>">
	<?php if(\dash\request::get('contain')) {?><input type="hidden" name="contain" value="<?php echo \dash\request::get('contain'); ?>"><?php }//endif ?>
	<div class="box">
		<div class="pad">
			<div class="row">
				<div class="c-xs-12	c-sm-4 c-lg-2">
					<?php if(\dash\data::accountingYear()) {?>
						<label for="parent"><?php echo T_("Accounting year") ?></label>
						<select class="select22" name="year_id">
							<option value=""><?php echo T_("Please choose year") ?></option>
							<?php foreach (\dash\data::accountingYear() as $key => $value) {?>
								<option value="<?php echo a($value, 'id') ?>" <?php if((!\dash\request::get('year_id') && a($value, 'isdefault')) || (a($value, 'id') === \dash\request::get('year_id'))) { echo 'selected';} ?>><?php echo a($value, 'title'); ?></option>
							<?php } // endfor ?>
						</select>
					<?php } // endif ?>
				</div>


				<div class="c-xs-6 c-sm-4 c-lg-2">
					<label for="startdate" ><?php echo T_("Start date"); ?></label>
					<div class="input mB0-f">
						<input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="startdate" id="startdate" value="<?php echo \dash\request::get('startdate'); ?>" autocomplete='off'>
					</div>
				</div>
				<div class="c-xs-6 c-sm-4 c-lg-2">
					<label for="enddate" ><?php echo T_("End date"); ?></label>
					<div class="input mB0-f">
						<input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="enddate" id="enddate" value="<?php echo \dash\request::get('enddate'); ?>" autocomplete='off'>
					</div>
				</div>

				<div class="c-xs-12	c-sm-4 c-lg-3">
					<?php if(\dash\data::groupList()) {?>
						<label for="group"><?php echo T_("Group") ?> <?php if(\dash\request::get('group')) {?><small><a target="_blank" class="link-primary" href="<?php echo \dash\url::this(). '/coding?view='. \dash\request::get('group'); ?>"><i class="sf-external-link"></i> <?php echo T_("View"); ?></a></small><?php }//endif ?></label>
						<select class="select22" name="group">
							<option value=""><?php echo T_("Please choose group") ?></option>
							<?php foreach (\dash\data::groupList() as $key => $value) {?>
								<option value="<?php echo a($value, 'id') ?>" <?php if(a($value, 'id') === \dash\request::get('group')) { echo 'selected';} ?>><?php echo a($value, 'full_title'); ?></option>
							<?php } // endfor ?>
						</select>
					<?php } // endif ?>
				</div>


				<div class="c-xs-12	c-sm-8 c-lg-3">
					<?php if(\dash\data::totalList()) {?>
						<label for="total"><?php echo T_("Accounting total") ?> <?php if(\dash\request::get('total')) {?><small><a target="_blank" class="link-primary" href="<?php echo \dash\url::this(). '/coding?view='. \dash\request::get('total'); ?>"><i class="sf-external-link"></i> <?php echo T_("View"); ?></a></small><?php }//endif ?></label>
						<select class="select22" name="total">
							<option value=""><?php echo T_("Please choose total") ?></option>
							<?php foreach (\dash\data::totalList() as $key => $value) {?>
								<option value="<?php echo a($value, 'id') ?>" <?php if(a($value, 'id') === \dash\request::get('total')) { echo 'selected';} ?>><?php echo a($value, 'full_title'); ?></option>
							<?php } // endfor ?>
						</select>
					<?php } // endif ?>
				</div>

				<div class="c-xs-12	c-sm-6 c-lg-6">
					<?php if(\dash\data::assistantList()) {?>
						<label for="assistant"><?php echo T_("Accounting assistant") ?> <?php if(\dash\request::get('assistant')) {?><small><a target="_blank" class="link-primary" href="<?php echo \dash\url::this(). '/coding?view='. \dash\request::get('assistant'); ?>"><i class="sf-external-link"></i> <?php echo T_("View"); ?></a></small><?php }//endif ?></label>
						<select class="select22" name="assistant">
							<option value=""><?php echo T_("Please choose assistant") ?></option>
							<?php foreach (\dash\data::assistantList() as $key => $value) {?>
								<option value="<?php echo a($value, 'id') ?>" <?php if(a($value, 'id') === \dash\request::get('assistant')) { echo 'selected';} ?>><?php echo a($value, 'full_title'); ?></option>
							<?php } // endfor ?>
						</select>
					<?php } // endif ?>
				</div>

				<div class="c-xs-12	c-sm-6 c-lg-6">
					<?php if(\dash\data::detailsList()) {?>
						<label for="details"><?php echo T_("Accounting details") ?></label>
						<select class="select22" name="details">
							<option value=""><?php echo T_("Please choose details") ?></option>
							<?php foreach (\dash\data::detailsList() as $key => $value) {?>
								<option value="<?php echo a($value, 'id') ?>" <?php if(a($value, 'id') == \dash\request::get('details')) { echo 'selected';} ?>><?php echo a($value, 'title'); ?></option>
							<?php } // endfor ?>
						</select>
					<?php } // endif ?>
				</div>

			</div>
		</div>
		<footer>
			<div class="f">
				<div class="cauto">
					<i class="sf-calculator mLR10" data-kerkere='.showDetailHide'></i>
				</div>
				<div class="cauto">
					<div class="showDetailHide" data-kerkere-content='hide'>

					<?php
						$x = floatval(\dash\data::summaryDetail_balance());
						$tax = $x;
						$tax_price = $x / 2;
						$total_sales = ($x / 6) * 100
					?>
					<div class="btn"><?php echo T_("Tax"); ?> <?php echo \dash\fit::number($tax) ?></div>
					<div class="btn"><?php echo T_("Tax price"); ?> <?php echo \dash\fit::number($tax_price) ?></div>
					<div class="btn"><?php echo T_("Total sales"); ?> <?php echo \dash\fit::number($total_sales) ?></div>
					</div>

				</div>
				<?php if(\dash\request::get('contain')) {?>
					<div class="cauto">
						<a class="btn" href="<?php echo \dash\url::this(). '/coding?view='. \dash\request::get('contain') ?>"><?php echo T_("View Accounting coding") ?></a>
					</div>
				<?php }// endif ?>
				<div class="c"></div>
				<div class="cauto">
					<?php if(\dash\data::dataTableDraft()) {?>
						<a class="btn-link" href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['status' => 'draft']) ?>"><?php echo T_("You have some draft document!") ?></a>
					<?php } // endif ?>
					<?php if(\dash\request::get()) {?>
						<a href="<?php echo \dash\url::current() ?>" class="btn sm secondary outline"><?php echo T_("Clear filter") ?></a>
					<?php } //endif ?>
					<button class="btn sm master"><?php echo T_("Apply") ?></button>
				</div>

			</div>

		</footer>
	</div>
</form>

<section class="row">

	<div class="c">
		<a class="stat" title="<?php echo \dash\fit::price(\dash\data::summaryDetail_balance_opening()); ?>" data-copy='<?php echo \dash\data::summaryDetail_debtor_opening(); ?>'>
			<h3><?php echo T_("Debtor from opening");?></h3>
			<div class="val ltr"><?php echo \dash\fit::price(\dash\data::summaryDetail_debtor_opening());?></div>
		</a>
	</div>

	<div class="c">
		<a class="stat" title="<?php echo \dash\fit::price(\dash\data::summaryDetail_balance_opening()); ?>" data-copy='<?php echo \dash\data::summaryDetail_creditor_opening(); ?>'>
			<h3><?php echo T_("Creditor from opening");?></h3>
			<div class="val ltr"><?php echo \dash\fit::price(\dash\data::summaryDetail_creditor_opening());?></div>
		</a>
	</div>


	<div class="c">
		<a class="stat" title="<?php echo \dash\fit::price(\dash\data::summaryDetail_balance()); ?>">
			<h3><?php echo T_("Debtor");?></h3>
			<?php $myPrice = \dash\data::summaryDetail_debtor();?>
			<div class="val ltr" data-copy="<?php echo $myPrice ?>"><?php echo \dash\fit::price($myPrice); ?></div>
		</a>
	</div>

	<div class="c">
		<a class="stat" title="<?php echo \dash\fit::price(\dash\data::summaryDetail_balance()); ?>">
			<h3><?php echo T_("Creditor");?></h3>
			<?php $myPrice = \dash\data::summaryDetail_creditor();?>
			<div class="val ltr" data-copy="<?php echo $myPrice ?>"><?php echo \dash\fit::price($myPrice); ?></div>
		</a>
	</div>


	<div class="c">
		<a class="stat" data-copy='<?php echo \dash\data::summaryDetail_final_balance(); ?>'>
			<h3><?php echo T_("End of period");?></h3>
			<div class="val ltr"><?php echo \dash\fit::price(\dash\data::summaryDetail_final_balance());?></div>
		</a>
	</div>

</section>
<?php if(\dash\data::dataTable()) {?>
	<table class="tbl1 v6  minimal text-sm">
		<thead>
			<tr>
				<th class=""><?php echo T_("Number") ?></th>

				<?php if(\dash\request::get('group')) {}else{ echo '<th>'. T_("Group"). '</th>'; }?>
				<?php if(\dash\request::get('total')) {}else{ echo '<th>'. T_("Accounting total"). '</th>'; }?>
				<?php if(\dash\request::get('assistant')) {}else{ echo '<th>'. T_("Accounting assistant"). '</th>'; }?>
				<?php if(\dash\request::get('details')) {}else{ echo '<th>'. T_("Accounting details"). '</th>'; }?>

				<th><?php echo T_("Date") ?></th>
				<?php if(\dash\request::get('status') === 'draft') { ?>
				<th><?php echo T_("Status") ?></th>
				<?php } // endif ?>


				<th><?php echo T_("Debtor") ?></th>
				<th><?php echo T_("Creditor") ?></th>
				<?php if(\dash\url::subchild() === 'detail' or true) {?>
					<th><?php echo T_("Remain") ?></th>
				<?php } //endif ?>
			</tr>
		</thead>
		<tbody>
				<?php $myDataTable = \dash\data::dataTable(); ?>
				<?php foreach ($myDataTable as $key => $value) {?>
				<tr class="text-sm">
					<td class="font-14">
						<a class="link-primary" href="<?php echo \dash\url::this(). '/doc/edit?id='. a($value, 'tax_document_id'); ?>">#<?php echo \dash\fit::number(a($value, 'number'), true, 'en'); ?></a>
					</td>


					<?php if(\dash\request::get('group')) {}else{?>
						<td>
							<a href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['group' => a($value, 'group_id'), 'total' => null, 'assistant' => null]); ?>"><?php echo a($value, 'group_title'); ?></a>
						</td>
					<?php } //endif ?>
					<?php if(\dash\request::get('total')) {}else{?>
						<td>
							<a href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['group' => a($value, 'group_id'), 'total' => a($value, 'total_id'), 'assistant' => null]); ?>"><?php echo a($value, 'total_title'); ?></a>
						</td>
						<?php } //endif ?>
					<?php if(\dash\request::get('assistant')) {}else{?>
						<td>
							<a href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['group' => a($value, 'group_id'), 'total' => a($value, 'total_id'), 'assistant' => a($value, 'assistant_id')]); ?>"><?php echo a($value, 'assistant_title'); ?></a>
						</td>
					<?php } //endif	 ?>
					<?php if(\dash\request::get('details')) {}else{?>
						<td>
							<a href="<?php echo \dash\url::current(). '?'. \dash\request::fix_get(['group' => a($value, 'group_id'), 'total' => a($value, 'total_id'), 'assistant' => a($value, 'assistant_id'), 'details' => a($value, 'details_id')]); ?>"><?php echo a($value, 'details_title'); ?></a>
						</td>
					<?php } //endif ?>
					<td class="font-bold"><?php echo \dash\fit::date(a($value, 'date')) ?></td>

					<?php if(\dash\request::get('status') === 'draft') { ?>
						<td><?php echo a($value, 'tstatus') ?></td>
					<?php } // endif ?>


					<td data-copy='<?php echo a($value, 'debtor') ?>' class="text-right ltr font-14 text-green-700"><?php echo \dash\fit::number_decimal(a($value, 'debtor'), 'en') ?></td>
					<td data-copy='<?php echo a($value, 'creditor') ?>' class="text-right ltr font-14 text-red-800"><?php echo \dash\fit::number_decimal(a($value, 'creditor'), 'en') ?></td>
					<?php if(\dash\url::subchild() === 'detail' or true) {?>
					<td data-copy='<?php echo a($value, 'balance_now') ?>' class="text-right ltr font-14 font-bold <?php if(a($value, 'balance_now') < 0){ echo 'text-red-800'; }else{ echo 'text-green-700';} ?>"><?php echo \dash\fit::number_decimal(a($value, 'balance_now'), 'en') ?></td>
					<?php } //endif ?>

				</tr>
				<tr>
					<td class="pTB5-f" colspan="12"><?php echo a($value, 'desc'). ' '. a($value, 'doc_desc'); ?></td>
				</tr>
			<?php } //endif ?>
		</tbody>
	</table>
	<?php \dash\utility\pagination::html(); ?>
<?php }else{ ?>
	<div class="msg fs14 success2"><?php echo T_("Hi!") ?></div>
<?php } //endif ?>
