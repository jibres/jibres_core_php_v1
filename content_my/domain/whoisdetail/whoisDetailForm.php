<div class="msg danger2">
	<p><?php echo T_("Please enter the email you have access to. After registering any international domain, you must confirm the domain registration process by this image. Please be careful") ?></p>
</div>
<label for="fullname">Full name <small class="fc-red">* Required</small></label>
<div class="input ltr">
	<input type="text" name="fullname" value="<?php echo \dash\data::userSettingDataRow_fullname(); ?>" placeholder2="<?php echo T_("Full name"); ?>" id="fullname" maxlength="60">
</div>
<label for="iemail">Email <small class="fc-red">* Required</small></label>
<div class="input ltr">
	<input type="email" name="email" value="<?php echo \dash\data::userSettingDataRow_email(); ?>" placeholder2="<?php echo T_("Email"); ?>" id="iemail" maxlength="60">
</div>

