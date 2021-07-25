<div class="bg-green-200">
	<div class="tblBox">

		<?php foreach (\dash\data::dataTable() as $key => $value) { ?>
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
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(3) ?></td>
							<td><?php echo T_("Export products include and not non-include vat") ?></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(4) ?></td>
							<td><?php echo T_("Total vat in this quarter") ?></td>
							<td data-copy='<?php echo a($value, 'income', 'this_totalincludevat'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'income', 'this_totalincludevat'), true, 'en') ?></code></td>
							<td data-copy='<?php echo a($value, 'income', 'this_totalvatinclude6'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'income', 'this_totalvatinclude6'), true, 'en') ?></code></td>
							<td data-copy='<?php echo a($value, 'income', 'this_totalvatinclude3'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'income', 'this_totalvatinclude3'), true, 'en') ?></code></td>
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
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(3) ?></td>
							<td><?php echo T_("Export products include and not non-include vat") ?></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(4) ?></td>
							<td><?php echo T_("Total vat in this quarter") ?></td>
							<td data-copy='<?php echo a($value, 'cost', 'this_totalincludevat'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'cost', 'this_totalincludevat'), true, 'en') ?></code></td>
							<td data-copy='<?php echo a($value, 'cost', 'this_totalvatinclude6'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'cost', 'this_totalvatinclude6'), true, 'en') ?></code></td>
							<td data-copy='<?php echo a($value, 'cost', 'this_totalvatinclude3'); ?>' class="font-12 ltr txtB fc-green"><code><?php echo \dash\fit::number(a($value, 'cost', 'this_totalvatinclude3'), true, 'en') ?></code></td>
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
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td class="collapsing"><?php echo \dash\fit::number(3) ?></td>
							<td><?php echo T_("Remain") ?></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
		<?php } //endfor ?>
	</div>
</div>
