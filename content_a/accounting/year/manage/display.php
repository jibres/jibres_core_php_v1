<div class="box">
	<header><h2><?php echo T_("Close all harmful-profit") ?></h2></header>
	<div class="body">
			<div class="msg primary2">
				<?php echo T_("Close all harmful-profit document") ?>
				<span class="btn master" data-confirm data-data='{"closeharmfullprofit": "closeharmfullprofit"}'><?php echo T_("Close Now") ?></span>
			</div>

			<div class="msg warn2">
				<?php echo T_("Move harmful-profit to accumulated") ?>
				<span class="btn master" data-confirm data-data='{"accumulated": "accumulated"}'><?php echo T_("Move Now") ?></span>
			</div>

			<div class="msg danger2">
				<?php echo T_("Send closing document") ?>
				<span class="btn master" data-confirm data-data='{"closing": "closing"}'><?php echo T_("Run Now") ?></span>
			</div>

		<?php if(\dash\data::closeHarmfullProfitList()) {?>
			<div class="tblBox">
				<table class="tbl1 v4">
					<thead>
						<tr>
							<th class="collapsing"></th>
							<th><?php echo T_("Group") ?></th>
							<th><?php echo T_("Assistant") ?></th>
							<th><?php echo T_("Accounting detail") ?></th>
							<th><?php echo T_("Debtor") ?></th>
							<th><?php echo T_("Creditor") ?></th>
							<th><?php echo T_("End value") ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach (\dash\data::closeHarmfullProfitList() as $key => $value) {?>
							<tr>
								<td class="collapsing"><?php echo \dash\fit::number($key + 1) ?></td>
								<td><?php echo $value['group_title'] ?></td>
								<td><?php echo $value['assistant_title'] ?></td>
								<td><?php echo $value['details_title'] ?></td>
								<td><?php echo \dash\fit::number_en($value['debtor']) ?></td>
								<td><?php echo \dash\fit::number_en($value['creditor']) ?></td>
								<td><?php echo \dash\fit::number_en($value['end_value']) ?></td>
							</tr>
						<?php } //endif ?>
					</tbody>
				</table>
			</div>
		<?php }else{ ?>
			<div class="msg"><?php echo T_("Document list is empty!") ?></div>
		<?php } //endif ?>
	</div>
</div>