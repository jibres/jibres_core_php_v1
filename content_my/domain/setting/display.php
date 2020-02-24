
<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">

			<div class="msg success txtB txtC fs14"><?php echo \dash\data::myDomain(); ?></div>
			<div class="msg txtC"><?php echo T_("Expire date"); ?> <?php echo \dash\fit::date(\dash\data::domainDetail_dateexpire()); ?></div>

			<div class="mB20" >

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



				<form method="post" autocomplete="off" class="mB20" >


				    <label for="iholder"><?php echo T_("Holder"); ?></label>
					<div class="input ltr">
						<input type="text" name="holder" id="iholder" maxlength="50" value="<?php echo \dash\data::domainDetail_holder(); ?>" >
					</div>

					<label for="iadmin"><?php echo T_("Admin"); ?></label>
					<div class="input ltr">
						<input type="text" name="admin" id="iadmin" maxlength="50" value="<?php echo \dash\data::domainDetail_admin(); ?>" >
					</div>

					<label for="itech"><?php echo T_("Technical"); ?></label>
					<div class="input ltr">
						<input type="text" name="tech" id="itech" maxlength="50" value="<?php echo \dash\data::domainDetail_tech(); ?>" >
					</div>

					<label for="ibill"><?php echo T_("Billing"); ?></label>
					<div class="input ltr">
						<input type="text" name="bill" id="ibill" maxlength="50" value="<?php echo \dash\data::domainDetail_bill(); ?>" >
					</div>

					<div class="c6 s12">
					    <label for="ns1"><?php echo T_("DNS #1"); ?></label>
						<div class="input ltr">
							<input type="text" name="ns1" id="ns1" maxlength="50" value="<?php echo \dash\data::domainDetail_ns1(); ?>" >
						</div>
						<label for="ns2"><?php echo T_("DNS #2"); ?></label>
						<div class="input ltr">
							<input type="text" name="ns2" id="ns2" maxlength="50" value="<?php echo \dash\data::domainDetail_ns2(); ?>" >
						</div>
			    	</div>

					<div class="txtRa">
						<button class="btn success"><?php echo T_("Update"); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


