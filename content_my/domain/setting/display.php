
<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">

			<div class="msg success txtB txtC fs14"><?php echo \dash\data::myDomain(); ?></div>
			<div class="msg txtC"><?php echo T_("Expire date"); ?> <?php echo \dash\fit::date(\dash\data::domainDetail_dateexpire()); ?></div>

			<form method="post" autocomplete="off" class="mB20" >

				<div class="f fs06">
					<div class="c6 s12">
						<div class="dcard x1 <?php if(\dash\data::domainDetail_lock()) { echo ' active';} ?>" data-confirm data-data='{"myaction" : "lock"}'>
						 <div class="statistic blue">
						  <div class="value"><i class="sf-lock"></i></div>
						  <div class="label"><?php echo T_("Lock domain"); ?></div>
						 </div>
						</div>
					</div>

					<div class="c6 s12">
						<div class="dcard x1 <?php if(!\dash\data::domainDetail_lock()) { echo ' active';} ?>" data-confirm data-data='{"myaction" : "unlock"}'>
						 <div class="statistic red">
						  <div class="value"><i class="sf-unlock"></i></div>
						  <div class="label"><?php echo T_("Unlock domain"); ?></div>
						 </div>
						</div>
					</div>

				</div>

				<?php if(\dash\data::domainDetail_autorenew()) {?>

				<div class="dcard fs08 x1 active" data-confirm data-data='{"myaction" : "autorenew", "op" :"unset"}'>
				 <div class="statistic blue">
				  <div class="value"><i class="sf-refresh"></i></div>
				  <div class="label"><?php echo T_("Disalbe Auto renew"); ?></div>
				 </div>
				</div>

				<?php }else{ ?>

				<div class="dcard fs08 x1" data-confirm data-data='{"myaction" : "autorenew", "op" :"set"}'>
				 <div class="statistic">
				  <div class="value"><i class="sf-refresh"></i></div>
				  <div class="label"><?php echo T_("Enable Auto renew"); ?></div>
				 </div>
				</div>

				<?php } //endif ?>

				<h4><?php echo T_("Renew domain"); ?></h4>
				<div class="f mB10">
			      <div class="c pRa5">
			          <div class="radio3">
			            <input type="radio" name="period" value="1year" id="period1year">
			            <label for="period1year"><?php echo T_("1 Year"); ?></label>
			          </div>
			      </div>
			      <div class="c">
			          <div class="radio3">
			            <input type="radio" name="period" value="5year" id="period5year">
			            <label for="period5year"><?php echo T_("5 Year"); ?></label>
			          </div>
			      </div>
			    </div>
			      <div class="check1">
			      <input type="checkbox" name="agree" id="agree">
			      <label for="agree"><?php echo T_("I have read and agree to the terms and conditions"); ?> <small><a target="_blank" href="https://www.nic.ir/Rules_and_Contracts"><?php echo T_("Show terms"); ?></a></small></label>
			    </div>
				<div class="txtRa">
					<button class="btn success"><?php echo T_("Renew"); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>


