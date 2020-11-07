
<section class="f" data-option='accounting-close-harmful-profit'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Close all harmful-profit document") ?></h3>
      <div class="body">
        <p><?php echo T_("In some cases, the system automatically issues documents that need a specific title. Set these titles in this section.");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
          <span class="btn master" data-confirm data-data='{"closeharmfullprofit": "closeharmfullprofit"}'><?php echo T_("Close Now") ?></span>
      </div>
  </div>
  <footer class="txtRa">
  	<div data-kerkere='.showListClosingHarmfulProfit' class="btn link"><?php echo T_("Show list") ?></div>
  </footer>
</section>

<div class="showListClosingHarmfulProfit" data-kerkere-content='hide'>
	<div class="box">
		<div class="body">

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
</div>


<section class="f" data-option='accounting-close-harmful-profit-accumulate'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Move harmful-profit to accumulated") ?></h3>
      <div class="body">
        <p><?php echo T_("In some cases, the system automatically issues documents that need a specific title. Set these titles in this section.");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
          <span class="btn master" data-confirm data-data='{"accumulated": "accumulated"}'><?php echo T_("Move Now") ?></span>
      </div>
  </div>

</section>



<section class="f" data-option='accounting-closing'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Send closing document") ?></h3>
      <div class="body">
        <p><?php echo T_("In some cases, the system automatically issues documents that need a specific title. Set these titles in this section.");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12" >
      <div class="action">
          <span class="btn master" data-confirm data-data='{"closing": "closing"}'><?php echo T_("Run Now") ?></span>
      </div>
  </div>
  <footer class="txtRa">
  	<div data-kerkere='.showClosingList' class="btn link"><?php echo T_("Show list") ?></div>
  </footer>
</section>

<div class="showClosingList" data-kerkere-content='hide'>
	<div class="box">
		<div class="body">
			<?php if(\dash\data::closingList()) {?>
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
							<?php foreach (\dash\data::closingList() as $key => $value) {?>
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
</div>