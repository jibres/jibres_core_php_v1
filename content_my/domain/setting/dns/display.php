<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>
<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">

				<form method="post" autocomplete="off" class="mB20" >
					<p><?php echo T_("You can edit your dns record") ?></p>

					  <div class="f">


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

				    	<div class="c6 s12">
				    		<div class="mLa5">
								<label for="ip1"><?php echo T_("IP #1"); ?></label>
								<div class="input ltr">
									<input type="text" name="ip1" id="ip1" maxlength="50" value="<?php echo \dash\data::domainDetail_ip1(); ?>" >
								</div>
								<label for="ip2"><?php echo T_("IP #2"); ?></label>
								<div class="input ltr">
									<input type="text" name="ip2" id="ip2" maxlength="50" value="<?php echo \dash\data::domainDetail_ip2(); ?>" >
								</div>
				    		</div>
				    	</div>

				    	<div class="c6 s12">
							<label for="ns3"><?php echo T_("DNS #3"); ?></label>
							<div class="input ltr">
								<input type="text" name="ns3" id="ns3" maxlength="50" value="<?php echo \dash\data::domainDetail_ns3(); ?>" >
							</div>
							<label for="ns4"><?php echo T_("DNS #4"); ?></label>
							<div class="input ltr">
								<input type="text" name="ns4" id="ns4" maxlength="50" value="<?php echo \dash\data::domainDetail_ns4(); ?>" >
							</div>
				    	</div>

				    	<div class="c6 s12">
				    		<div class="mLa5">
								<label for="ip3"><?php echo T_("IP #3"); ?></label>
								<div class="input ltr">
									<input type="text" name="ip3" id="ip3" maxlength="50" value="<?php echo \dash\data::domainDetail_ip3(); ?>" >
								</div>

								<label for="ip4"><?php echo T_("IP #4"); ?></label>
								<div class="input ltr">
									<input type="text" name="ip4" id="ip4" maxlength="50" value="<?php echo \dash\data::domainDetail_ip4(); ?>" >
								</div>
				    		</div>
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


