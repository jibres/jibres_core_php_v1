

<div class='flex fix' id='ecodeSend'>
    <label for='code'>Code</label>
    <input id='code' name="code" type='number' readonly placeholder='<?php echo T_("Code"); ?>' title='<?php echo T_("Send this code to our number!"); ?>' value="<?php echo \dash\data::codeSend(); ?>">
   </div>

<div class='flex fix' id='enumberSend'>
    <label for='ErmileMobileNumber'><a href="sms://<?php echo \dash\data::codeSendNumSMS(); ?>;?&body=<?php echo \dash\data::codeSend(); ?>">SMS </a></label>
    <input id='ErmileMobileNumber' name="ErmileMobileNumber" type='tel' readonly placeholder='<?php echo T_("send to this number"); ?>' title='<?php echo T_("Send code to this number!"); ?>' value="<?php echo \dash\data::codeSendNum(); ?>">
   </div>


<p><?php echo \dash\data::codeSendMsg(); ?></p>
<p><?php echo \dash\data::codeSendSMS(); ?></p>

 <div class='flex' id='egoCheck'>
    <button type="submit"><?php echo T_("Go and check it"); ?></button>
   </div>




   <footer class='f'>

	<?php if(\dash\data::startNewMobile()) { ?>
		<a class="c link" href="<?php echo \dash\url::kingdom(); ?>/enter"><?php echo T_("Restart with new mobile"); ?></a>
	<?php }//endif ?>

	<a class="link cauto" href="<?php echo \dash\url::here(); ?>/verify"><?php echo T_("Go back"); ?></a>
   </footer>

