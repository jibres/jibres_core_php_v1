
<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">
		<?php if(\dash\data::myDomain()) {?>

		<div class="msg success2 txtC txtB">

			<?php echo \dash\data::myDomain(); ?>

		</div>

		<?php }else{ ?>

			<form method="post" autocomplete="off" class="mB20" action="<?php echo \dash\url::this(); ?>/buy">
				<input type="hidden" name="whois" value="1">
				<div class="input ltr">
					<input type="text" name="domain" placeholder='<?php echo T_("Domain"); ?>' value="<?php echo \dash\data::myDomain(); ?>">
					<button class="btn addon success"><?php echo T_("Check domain"); ?></button>
				</div>
			</form>



			<?php if(\dash\data::domainError()) {?>
			<div class="msg danger"><?php echo \dash\data::domainError(); ?></div>
			<?php } //endif ?>

			<?php if(\dash\data::checkResult()) {?>

				<?php if(\dash\data::checkResult_available()) {?>

				<div class="msg success2"><?php echo T_("Domain is available"); ?>
					<span class="floatL">
						<a class="btn success" href="<?php echo \dash\url::this(); ?>/buy/<?php echo \dash\url::child(); ?>"><?php echo T_("Buy"); ?></a>
					</span>
				</div>

				<?php }else{ ?>

				<div class="msg warn2"><?php echo T_("Domain is occupied"); ?>
					<span class="floatL">
						<a class="btn warn" target="_blank" href="<?php echo \dash\url::kingdom(); ?>/whois/<?php echo \dash\url::child(); ?>"><?php echo T_("Whois"); ?></a>
					</span>
				</div>

				<?php } //endif ?>

			<?php } // endif ?>

		<?php } //endif ?>


		<?php if(\dash\data::checkResult()) {?>

			<?php if(\dash\data::checkResult_available()) {?>

				<form method="post" autocomplete="off" action="<?php echo \dash\url::that(); ?>">

				<?php if(\dash\url::child()) {?>

					<input type="hidden" name="domain" value="<?php echo \dash\url::child(); ?>">

				<?php }//endif ?>

				<label for="irnicid"><?php echo T_("IRNIC contact"); ?> <small><a target="_blank" href="<?php echo \dash\url::this(); ?>/contact/add?type=new"><?php echo T_("Create new IRNIC contact"); ?></a></small></label>
				<select name="irnicid" class="select ui dropdown search addition" id="irnicid">
				<option value=""><?php echo T_("IRNIC contact id"); ?></option>

				<?php foreach (\dash\data::myContactList() as $key => $value) {?>

				  <option value="<?php echo @$value['nic_id']; ?>" <?php if(isset($value['isdefault']) && $value['isdefault']) { echo "selected"; } ?>><?php echo @$value['nic_id']; ?></option>

				<?php } //endfor ?>

				</select>



				<div class="f mB10">
			      <div class="c pRa5">
			          <div class="radio3">
			            <input type="radio" name="period" value="1year" id="period1year">
			            <label for="period1year"><?php echo T_("1 Year"); ?> <span> <?php echo \dash\fit::number('3000'). ' '. T_("Toman"); ?> </span></label>
			          </div>
			      </div>
			      <div class="c">
			          <div class="radio3">
			            <input type="radio" name="period" value="5year" id="period5year">
			            <label for="period5year"><?php echo T_("5 Year"); ?> <span> <?php echo \dash\fit::number('15000'). ' '. T_("Toman"); ?> </span></label>
			          </div>
			      </div>
			    </div>


			    <label for="dnsid"><?php echo T_("DNS records"); ?> <small><a data-kerkere='.addNewDns' ><?php echo T_("Create new DNS"); ?></a></small></label>
				<select name="dnsid" class="select ui dropdown search addition" id="dnsid">
				<option value=""><?php echo T_("DNS record"); ?></option>
				<?php foreach (\dash\data::myContactList() as $key => $value) {?>


				  <option value="<?php echo \dash\coding::encode(@$value['id']); ?>" <?php if(isset($value['isdefault']) && $value['isdefault']) { echo "selected"; } ?>><?php echo @$value['title']. ' - '. @$value['ns1']; ?></option>

				<?php } //endfor ?>
				</select>

				<div class='addNewDns' data-kerkere-content='hide'>

				    <div class="f">
				    	<div class="c6 s12">
						    <label for="ns1"><?php echo T_("DNS #1"); ?></label>
							<div class="input">
								<input type="text" name="ns1" id="ns1" maxlength="100">
							</div>
				    	</div>

				    	<div class="c6 s12">
				    		<div class="mLa5">
								<label for="ns2"><?php echo T_("DNS #2"); ?></label>
								<div class="input">
									<input type="text" name="ns2" id="ns2" maxlength="100">
								</div>
				    		</div>
				    	</div>

				    	<div class="c6 s12">
							<label for="ns3"><?php echo T_("DNS #3"); ?></label>
							<div class="input">
								<input type="text" name="ns3" id="ns3" maxlength="100">
							</div>
				    	</div>

				    	<div class="c6 s12">
				    		<div class="mLa5">
								<label for="ns4"><?php echo T_("DNS #4"); ?></label>
								<div class="input">
									<input type="text" name="ns4" id="ns4" maxlength="100">
								</div>
				    		</div>
				    	</div>
				    </div>

				</div>

			    <div class="check1">
			      <input type="checkbox" name="agree" id="agree">
			      <label for="agree"><?php echo T_("I have read and agree to the terms and conditions"); ?> <small><a target="_blank" href="https://www.nic.ir/Rules_and_Contracts"><?php echo T_("Show terms"); ?></a></small></label>
			    </div>

				<div class="txtRa">
					<button class="btn success"><?php echo T_("Buy"); ?></button>
				</div>
			</form>

			<?php }else{ ?>

			<div class="msg warn2">
				<?php echo T_("Domain is occupied"); ?>
				<span class="floatL">
					<a class="btn warn" target="_blank" href="<?php echo \dash\url::kingdom(); ?>/whois/<?php echo \dash\data::myDomain(); ?>"><?php echo T_("Whois"); ?></a>
				</span>
			</div>
			<div class="txtRa">
				<a href="<?php echo \dash\url::that(); ?>" class="btn secondary"><?php echo T_("Never mind"); ?></a>
			</div>
			<?php } //endif ?>

		<?php }elseif(\dash\url::subchild()) {?>
			<div class="msg warn2"><?php echo T_("Invalid domain"); ?></div>
			<div class="txtRa">
				<a href="<?php echo \dash\url::that(); ?>" class="btn secondary"><?php echo T_("Never mind"); ?></a>
			</div>
		<?php } //endif ?>
		</div>
	</div>
</div>

