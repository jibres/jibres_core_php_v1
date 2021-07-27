<div class="avand font-16">

<?php foreach (\dash\data::dataTable() as $key => $value) { foreach ($value as $k => $v) {?>

			<table class="tbl1 v6">
				<tbody>
					<tr>
						<td class="collapsing"><?php echo T_("Report type") ?></td>
						<td class="txtB"><?php if(\dash\request::get('type') === 'costasset') {echo T_("Buy");}else{echo T_("Sell");} ?></td>
						<td></td>
						<td>---</td>
					</tr>

					<tr>
						<td class="collapsing"><?php echo T_("Type") ?></td>
						<td class="txtB" data-copy='<?php echo a($v, 'user_detail', 'accounttype'); ?>'><?php echo T_(ucfirst(a($v, 'user_detail', 'accounttype'))); ?></td>
						<td class="collapsing"><?php echo T_("Seller type"); ?></td>
						<td class="txtB">---</td>
					</tr>
					<tr>
						<td class="collapsing"></td>
						<td class="txtB"></td>
						<td class="collapsing"><?php echo T_("Company name") ?></td>
						<td class="txtB" data-copy='<?php echo a($v, 'user_detail', 'companyname'); ?>'><?php echo a($v, 'user_detail', 'companyname'); ?></td>
					</tr>

					<tr>
						<td class="collapsing"><?php echo T_("Company E-conomic code") ?></td>
						<td class="txtB" data-copy='<?php echo a($v, 'user_detail', 'companyeconomiccode'); ?>'><?php echo a($v, 'user_detail', 'companyeconomiccode'); ?></td>
						<td class="collapsing"><?php echo T_("Company National ID") ?></td>
						<td class="txtB" data-copy='<?php echo a($v, 'user_detail', 'companynationalid'); ?>'><?php echo a($v, 'user_detail', 'companynationalid'); ?></td>
					</tr>

					<tr>
						<td class="collapsing"><?php echo T_("Province") ?></td>
						<td class="txtB" data-copy='<?php echo a($v, 'address_detail', 'province_name'); ?>'><?php echo a($v, 'address_detail', 'province_name'); ?></td>
						<td class="collapsing"><?php echo T_("City") ?></td>
						<td class="txtB" data-copy='<?php echo a($v, 'address_detail', 'city_name'); ?>'><?php echo a($v, 'address_detail', 'city_name'); ?></td>
					</tr>

					<tr>
						<td class="collapsing"><?php echo T_("Address") ?></td>
						<td class="txtB" data-copy='<?php echo a($v, 'address_detail', 'address'); ?>'><?php echo a($v, 'address_detail', 'address'); ?></td>
						<td class="collapsing"><?php echo T_("Postalcode") ?></td>
						<td class="txtB" data-copy='<?php echo a($v, 'address_detail', 'postcode'); ?>'><?php echo a($v, 'address_detail', 'postcode'); ?></td>
					</tr>


					<tr>
						<td class="collapsing"><?php echo T_("Product title") ?></td>
						<td class="txtB" data-copy='<?php echo a($v, 'producttitle'); ?>'><?php echo a($v, 'producttitle'); ?></td>
						<td class="collapsing"></td>
						<td class="txtB"></td>
					</tr>

				</tbody>
			</table>
			<table class="tbl1 v4">
				<tbody>
					<tr>
						<td><?php echo T_("Total") ?></td>
						<td class="txtB" data-copy='<?php echo round(a($v, 'total')); ?>'><?php echo round(a($v, 'total')); ?></td>
					</tr>
					<tr>
						<td><?php echo T_("Discount") ?></td>
						<td class="txtB" data-copy='<?php echo round(a($v, 'totaldiscount')); ?>'><?php echo round(a($v, 'totaldiscount')); ?></td>
					</tr>
					<tr>
						<td><?php echo T_("Vat 6%") ?></td>
						<td class="txtB" data-copy='<?php echo round(a($v, 'totalvatinclude6')); ?>'><?php echo round(a($v, 'totalvatinclude6')); ?></td>
					</tr>
					<tr>
						<td><?php echo T_("Vat 3%") ?></td>
						<td class="txtB" data-copy='<?php echo round(a($v, 'totalvatinclude3')); ?>'><?php echo round(a($v, 'totalvatinclude3')); ?></td>
					</tr>
				</tbody>
			</table>

<?php } //endfor ?>
<?php } //endfor ?>
</div>