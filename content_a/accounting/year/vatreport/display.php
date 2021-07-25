
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
<div class="bg-green-200">
	<div class="tblBox">

		<?php foreach (\dash\data::dataTable() as $key => $value) {
			if(\dash\request::get('quarter') && intval(\dash\request::get('quarter')) !== intval($key))
			{
				continue;
			}
			?>
			<div class="mA20">
				<h3><?php echo T_("Table #1. Sale product report and service") ?></h3>
				<table class="tbl1 v6">
					<thead>
						<tr>
							<th class="collapsing"><?php echo T_("Code") ?></th>
							<th><?php echo T_("Description") ?></th>
							<th><?php echo T_("Total sales") ?></th>
							<th><?php echo T_("Vat 6%") ?></th>
							<th><?php echo T_("Vat 3%") ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(1) ?></td>
							<td><?php echo T_("Sale include vat products") ?></td>
							<td data-copy='<?php echo a($value, 'income', 'totalincludevat'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'income', 'totalincludevat'), true, 'en') ?></code></td>
							<td data-copy='<?php echo a($value, 'income', 'totalvatinclude6'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'income', 'totalvatinclude6'), true, 'en') ?></code></td>
							<td data-copy='<?php echo a($value, 'income', 'totalvatinclude3'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'income', 'totalvatinclude3'), true, 'en') ?></code></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(2) ?></td>
							<td><?php echo T_("Sale non-include vat products") ?></td>
							<td data-copy='<?php echo a($value, 'income', 'totalnotincludevat'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'income', 'totalnotincludevat'), true, 'en') ?></code></td>
							<td>-</td>
							<td>-</td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(3) ?></td>
							<td><?php echo T_("Export products include and not non-include vat") ?></td>
							<td data-copy='0' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(0, true, 'en') ?></code></td>
							<td>-</td>
							<td>-</td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(4) ?></td>
							<td><?php echo T_("Total vat in this quarter") ?></td>
							<td data-copy='<?php echo a($value, 'income', 'final'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'income', 'final'), true, 'en') ?></code></td>
							<td data-copy='<?php echo a($value, 'income', 'totalvat6'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'income', 'totalvat6'), true, 'en') ?></code></td>
							<td data-copy='<?php echo a($value, 'income', 'totalvat3'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'income', 'totalvat3'), true, 'en') ?></code></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="mA20">
				<h3><?php echo T_("Table #2. Buy product report and service") ?></h3>
				<table class="tbl1 v6">
					<thead>
						<tr>
							<th class="collapsing"><?php echo T_("Code") ?></th>
							<th><?php echo T_("Description") ?></th>
							<th><?php echo T_("Total cost") ?></th>
							<th><?php echo T_("Vat 6%") ?></th>
							<th><?php echo T_("Vat 3%") ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(1) ?></td>
							<td><?php echo T_("Cost include vat products") ?></td>
							<td data-copy='<?php echo a($value, 'cost', 'totalincludevat'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'cost', 'totalincludevat'), true, 'en') ?></code></td>
							<td data-copy='<?php echo a($value, 'cost', 'totalvatinclude6'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'cost', 'totalvatinclude6'), true, 'en') ?></code></td>
							<td data-copy='<?php echo a($value, 'cost', 'totalvatinclude3'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'cost', 'totalvatinclude3'), true, 'en') ?></code></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(2) ?></td>
							<td><?php echo T_("Cost non-include vat products") ?></td>
							<td data-copy='<?php echo a($value, 'cost', 'totalnotincludevat'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'cost', 'totalnotincludevat'), true, 'en') ?></code></td>
							<td>-</td>
							<td>-</td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(3) ?></td>
							<td><?php echo T_("Import products include vat") ?></td>
							<td data-copy='0' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(0, true, 'en') ?></code></td>
							<td data-copy='0' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(0, true, 'en') ?></code></td>
							<td data-copy='0' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(0, true, 'en') ?></code></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(3) ?></td>
							<td><?php echo T_("Import products non-include vat") ?></td>
							<td data-copy='0' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(0, true, 'en') ?></code></td>
							<td>-</td>
							<td>-</td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(4) ?></td>
							<td><?php echo T_("Total vat in this quarter") ?></td>
							<td data-copy='<?php echo a($value, 'cost', 'final'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'cost', 'final'), true, 'en') ?></code></td>
							<td data-copy='<?php echo a($value, 'cost', 'totalvat6'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'cost', 'totalvat6'), true, 'en') ?></code></td>
							<td data-copy='<?php echo a($value, 'cost', 'totalvat3'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'cost', 'totalvat3'), true, 'en') ?></code></td>
						</tr>
					</tbody>
				</table>
			</div>
				<div class="mA20">
				<h3><?php echo T_("Table #3. Calculate remain vat") ?></h3>
				<table class="tbl1 v6">
					<thead>
						<tr>
							<th class="collapsing"><?php echo T_("Code") ?></th>
							<th><?php echo T_("Description") ?></th>
							<th><?php echo T_("Vat 6%") ?></th>
							<th><?php echo T_("Vat 3%") ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(1) ?></td>
							<td><?php echo T_("Total vat payed. (Calculate automatic)") ?></td>
							<td data-copy='<?php echo a($value, 'cost', 'totalincludevat'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'cost', 'totalincludevat'), true, 'en') ?></code></td>
							<td data-copy='<?php echo a($value, 'cost', 'totalvatinclude6'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'cost', 'totalvatinclude6'), true, 'en') ?></code></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(2) ?></td>
							<td><?php echo T_("Minus") ?></td>
							<td>-</td>
							<td>-</td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(3) ?></td>
							<td><?php echo T_("Remain") ?></td>
							<td>-</td>
							<td>-</td>
						</tr>
					</tbody>
				</table>
			</div>
		<?php } //endfor ?>
	</div>
</div>
