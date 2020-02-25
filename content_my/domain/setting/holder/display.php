<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>
<div class="f justify-center">
	<div class="c6 m8 s12">
		<div class="cbox">




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

					<div class="txtRa">
						<button class="btn success"><?php echo T_("Update"); ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


