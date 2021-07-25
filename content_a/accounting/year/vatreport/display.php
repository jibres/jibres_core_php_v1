<section class="f">
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'); ?>" class="stat x70 <?php if(!\dash\request::get('quarter')) { echo 'active';} ?>">
			<h3><?php echo T_("All");?></h3>
			<div class="val"><?php echo \dash\data::dataRow_title() ?></div>
		</a>
	</div>
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'quarter' => 1]); ?>" class="stat x70 <?php if(\dash\request::get('quarter') === '1') { echo 'active';} ?>">
			<h3><?php echo T_("Quarter 1");?></h3>
			<div class="val"><?php echo T_("Spring");?></div>
		</a>
	</div>
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'quarter' => 2]); ?>" class="stat x70 <?php if(\dash\request::get('quarter') === '2') { echo 'active';} ?>">
			<h3><?php echo T_("Quarter 2");?></h3>
			<div class="val"><?php echo T_("Summer");?></div>
		</a>
	</div>
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'quarter' => 3]); ?>" class="stat x70 <?php if(\dash\request::get('quarter') === '3') { echo 'active';} ?>">
			<h3><?php echo T_("Quarter 3");?></h3>
			<div class="val"><?php echo T_("Autumn");?></div>
		</a>
	</div>
	<div class="c">
		<a href="<?php echo \dash\url::current(). '?'. \dash\request::build_query(['id' => \dash\request::get('id'), 'quarter' => 4]); ?>" class="stat x70 <?php if(\dash\request::get('quarter') === '4') { echo 'active';} ?>">
			<h3><?php echo T_("Quarter 4");?></h3>
			<div class="val"><?php echo T_("Winter");?></div>
		</a>
	</div>
</section>
<div class="bg-green-100">
	<div class="tblBox fs12">
		<?php foreach (\dash\data::dataTable() as $key => $value) {
			if(\dash\request::get('quarter') && intval(\dash\request::get('quarter')) !== intval($key))
			{
				continue;
			}
			?>
			<?php if(!\dash\request::get('quarter')) {?><hr><h2><?php echo T_("Quarter $key") ?></h2><?php } //endif ?>
			<div class="mA20">
				<h5><?php echo T_("Table #1. Sale product report and service") ?></h5>
				<table class="tbl1 v1">
					<thead>
						<tr>
							<th class="w-2 collapsing"><?php echo T_("Code") ?></th>
							<th class="w-10"><?php echo T_("Description") ?></th>
							<th class="w-4"><?php echo T_("Total sales") ?></th>
							<th class="w-4"><?php echo T_("Vat 6%") ?></th>
							<th class="w-4"><?php echo T_("Vat 3%") ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(1) ?></td>
							<td class="w-10"><?php echo T_("Sale <b>include</b> vat products") ?></td>
							<td class="w-4" data-copy='<?php echo a($value, 'income', 'totalincludevat'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'income', 'totalincludevat'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'income', 'totalvatinclude6'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'income', 'totalvatinclude6'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'income', 'totalvatinclude3'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'income', 'totalvatinclude3'), true, 'en') ?>"></div></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(2) ?></td>
							<td class="w-10"><?php echo T_("Sale <b>non-include</b> vat products") ?></td>
							<td class="w-4" data-copy='<?php echo a($value, 'income', 'totalnotincludevat'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'income', 'totalnotincludevat'), true, 'en') ?>"></div></td>
							<td class="w-4"><div class="bg-gray-300">&nbsp;</div></td>
							<td class="w-4"><div class="bg-gray-300">&nbsp;</div></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(3) ?></td>
							<td class="w-10"><?php echo T_("<b>Export</b> products <b>include and not non-include vat</b>") ?></td>
							<td class="w-4" data-copy='0'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(0, true, 'en') ?>"></div></td>
							<td class="w-4"><div class="bg-gray-300">&nbsp;</div></td>
							<td class="w-4"><div class="bg-gray-300">&nbsp;</div></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(4) ?></td>
							<td class="w-10"><?php echo T_("Total vat in this quarter + export + vat") ?></td>
							<td class="w-4" data-copy='<?php echo a($value, 'income', 'final'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'income', 'final'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'income', 'totalvatinclude6'); ?>'><div class="input ltr bg-green-500"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'income', 'totalvatinclude6'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'income', 'totalvatinclude3'); ?>'><div class="input ltr bg-green-500"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'income', 'totalvatinclude3'), true, 'en') ?>"></div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mA20">
				<h5><?php echo T_("Table #2. Buy product report and service") ?></h5>
				<table class="tbl1 v1">
					<thead>
						<tr>
							<th class="w-2 collapsing"><?php echo T_("Code") ?></th>
							<th class="w-10"><?php echo T_("Description") ?></th>
							<th><?php echo T_("Total cost") ?></th>
							<th><?php echo T_("Vat 6%") ?></th>
							<th><?php echo T_("Vat 3%") ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(1) ?></td>
							<td class="w-10"><?php echo T_("Buy products with <b>include vat</b>") ?></td>
							<td class="w-4" data-copy='<?php echo a($value, 'cost', 'totalincludevat'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'cost', 'totalincludevat'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'cost', 'totalvatinclude6'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'cost', 'totalvatinclude6'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'cost', 'totalvatinclude3'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'cost', 'totalvatinclude3'), true, 'en') ?>"></div></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(2) ?></td>
							<td class="w-10"><?php echo T_("Buy products with <b>non-include vat</b>") ?></td>
							<td class="w-4" data-copy='<?php echo a($value, 'cost', 'totalnotincludevat'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'cost', 'totalnotincludevat'), true, 'en') ?>"></div></td>
							<td class="w-4"><div class="bg-gray-300">&nbsp;</div></td>
							<td class="w-4"><div class="bg-gray-300">&nbsp;</div></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(3) ?></td>
							<td class="w-10"><?php echo T_("Import products <b>include vat</b>") ?></td>

							<td class="w-4" data-copy='0'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(0, true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='0'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(0, true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='0'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(0, true, 'en') ?>"></div></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(3) ?></td>
							<td class="w-10"><?php echo T_("Import products <b>non-include vat</b>") ?></td>
							<td class="w-4" data-copy='0'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(0, true, 'en') ?>"></div></td>
							<td class="w-4"><div class="bg-gray-300">&nbsp;</div></td>
							<td class="w-4"><div class="bg-gray-300">&nbsp;</div></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(4) ?></td>
							<td class="w-10"><?php echo T_("Total buy and import in this quarter") ?></td>
							<td class="w-4" data-copy='<?php echo a($value, 'cost', 'final'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'cost', 'final'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'cost', 'totalvatinclude6'); ?>'><div class="input ltr bg-yellow-500"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'cost', 'totalvatinclude6'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'cost', 'totalvatinclude3'); ?>'><div class="input ltr bg-yellow-500"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'cost', 'totalvatinclude3'), true, 'en') ?>"></div></td>

						</tr>
					</tbody>
				</table>
			</div>
			<div class="mA20">
				<h5><?php echo T_("Table #3. Calculate remain vat") ?></h5>
				<table class="tbl1 v1">
					<thead>
						<tr>
							<th class="w-2 collapsing"><?php echo T_("Code") ?></th>
							<th class="w-10"><?php echo T_("Description") ?></th>
							<th><?php echo T_("Vat 6%") ?></th>
							<th><?php echo T_("Vat 3%") ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(1) ?></td>
							<td class="w-10"><?php echo T_("<b>Total</b> vat payed") ?> <small class="fc-red"><?php echo T_("This section calculate automatic") ?></small></td>
							<td class="w-4" data-copy='<?php echo a($value, 'cost', 'totalvatinclude6'); ?>'><div class="input ltr bg-yellow-500"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'cost', 'totalvatinclude6'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'cost', 'totalvatinclude3'); ?>'><div class="input ltr bg-yellow-500"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'cost', 'totalvatinclude3'), true, 'en') ?>"></div></td>

						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(2) ?></td>
							<td class="w-10"><?php echo T_("<b>(Minus)</b> Total vat can not be refund") ?></td>
							<td class="w-4" data-copy='0'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(0, true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='0'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(0, true, 'en') ?>"></div></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(3) ?></td>
							<td class="w-10"><?php echo T_("<b>Remain</b> vat refundable") ?> <small class="fc-red"><?php echo T_("This section calculate automatic") ?></small></td>
							<td class="w-4" data-copy='<?php echo a($value, 'cost', 'totalvatinclude6'); ?>'><div class="input ltr bg-red-500"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'cost', 'totalvatinclude6'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'cost', 'totalvatinclude3'); ?>'><div class="input ltr bg-red-500"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'cost', 'totalvatinclude3'), true, 'en') ?>"></div></td>

						</tr>
					</tbody>
				</table>
			</div>
			<div class="mA20">
				<h5><?php echo T_("B. Calculate remain vat") ?></h5>
				<table class="tbl1 v1">
					<thead>
						<tr>
							<th class="w-2 collapsing"><?php echo T_("Row") ?></th>
							<th class="w-10"><?php echo T_("Description") ?></th>
							<th><?php echo T_("Accounting Vat") ?></th>
							<th><?php echo T_("Accounting Tax") ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(1) ?></td>
							<td class="w-10"><?php echo T_("Total vat payed. (From table 1)") ?></td>
							<td class="w-4" data-copy='<?php echo a($value, 'income', 'totalvatinclude6'); ?>'><div class="input ltr bg-green-500"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'income', 'totalvatinclude6'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'income', 'totalvatinclude3'); ?>'><div class="input ltr bg-green-500"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'income', 'totalvatinclude3'), true, 'en') ?>"></div></td>

						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(2) ?></td>
							<td class="w-10"><?php echo T_("Total vat. (From table 3)") ?></td>
							<td class="w-4" data-copy='<?php echo a($value, 'cost', 'totalvatinclude6'); ?>'><div class="input ltr bg-red-500"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'cost', 'totalvatinclude6'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'cost', 'totalvatinclude3'); ?>'><div class="input ltr bg-red-500"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'cost', 'totalvatinclude3'), true, 'en') ?>"></div></td>

						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(3) ?></td>
							<td class="w-10"><?php echo T_("Remain vat from last quarter or year.") ?></td>
							<td class="w-4" data-copy='<?php echo a($value, 'last_remainvat6'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'last_remainvat6'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'last_remainvat3'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'last_remainvat3'), true, 'en') ?>"></div></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(4) ?></td>
							<td class="w-10"><?php echo T_("Total remain. Negative number if creditor") ?> <small class="fc-red"><?php echo T_("This section calculate automatic") ?></small></td>
							<td class="w-4" data-copy='<?php echo a($value, 'remainvat6'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'remainvat6'), true, 'en') ?>"></div></td>
							<td class="w-4" data-copy='<?php echo a($value, 'remainvat3'); ?>'><div class="input ltr"><input disabled type="text" value="<?php echo \dash\fit::number(a($value, 'remainvat3'), true, 'en') ?>"></div></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mA20">
				<h5><?php echo T_("C. Decide on overpayment") ?></h5>
				<form method="post" autocomplete="off" data-patch>
					<input type="hidden" name="quarter" value="<?php echo $key; ?>">
					<div class="radio1">
						<input type="radio" name="decide" value="move" id="<?php echo $key. '_move-id' ?>" <?php if(a(\dash\data::dataRow(), 'vatsetting', $key, 'decide') === 'move'){ echo 'checked';} ?>>
						<label for="<?php echo $key. '_move-id' ?>"><?php echo T_("Move to next quarter") ?></label>
					</div>
					<div class="radio1">
						<input type="radio" name="decide" value="refund" id="<?php echo $key. '_refund-id' ?>" <?php if(a(\dash\data::dataRow(), 'vatsetting', $key, 'decide') === 'refund'){ echo 'checked';} ?>>
						<label for="<?php echo $key. '_refund-id' ?>"><?php echo T_("Refund the vat") ?></label>
					</div>
				</form>
			</div>
		<?php } //endfor ?>
	</div>
</div>