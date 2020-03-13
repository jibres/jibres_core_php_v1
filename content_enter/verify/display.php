
<div class='flex fix'>
    <input id='usernameormobile' name="usernameormobile" type='tel' data-disallowFaNum maxlength="15" placeholder='<?php echo T_("Mobile"); ?>' data-invalid='<?php echo T_("Please enter valid mobile or username or email number"); ?>' value="<?php echo \dash\data::getUsernamemobile(); ?>" data-pl-user='<?php echo T_("Username or Mobile or Email"); ?>' autocomplete="off" required
    	<?php
    	if(\dash\data::mobileReadonly())
    	{
    		echo ' readonly';
    	}
    	else
    	{
    		echo ' autofocus title="'. T_("Username or Mobile or email"). '"';
    	}

    	if(!\dash\user::id())
    	{
    		echo ' pattern=".{5,50}"';
    	}
    	?>
      >
   </div>

<?php
$sendWayCod = \dash\data::sendWayCod();
?>

  <div class="fs08">

<?php if(in_array('telegram', $sendWayCod)) { ?>
	<div class="radio1">
		<input type="radio" name="sendCode" value="telegram" id="sRd3" checked autofocus>
		<label for="sRd3"><?php echo T_("Send code in your Telegram"); ?></label>
	</div>
<?php } // endif ?>

<?php if(in_array('sms', $sendWayCod)) { ?>
	<div class="radio1">
		<input type="radio" name="sendCode" value="sms" id="sRd1" <?php if(!in_array('telegram', $sendWayCod)) { ?>checked autofocus <?php }//endif ?>	>
		<label for="sRd1"><?php echo T_("Send code as sms to your phone"); ?></label>
	</div>
<?php } // endif ?>

<?php if(in_array('call', $sendWayCod)) { ?>
	<div class="radio1">
		<input type="radio" name="sendCode" value="call" id="sRd2">
		<label for="sRd2"><?php echo T_("Call you to send code"); ?></label>
	</div>
<?php } // endif ?>


<?php if(in_array('sendsms', $sendWayCod)) { ?>
	<div class="radio1">
		<input type="radio" name="sendCode" value="sendsms" id="sRd4">
		<label for="sRd4"><?php echo T_("You send code to us and we check it"); ?></label>
	</div>
<?php } // endif ?>



<?php if(in_array('later', $sendWayCod)) { ?>
	<div class="radio1">
		<input type="radio" name="sendCode" value="later" id="sRd5">
		<label for="sRd5"><?php echo T_("Verify later"); ?></label>
	</div>
<?php } // endif ?>
  </div>


<div class='flex' id='ego'>
    <button type="submit"><?php echo T_("Go"); ?></button>
   </div>

<?php
if (\dash\data::rememberLink())
{
?>

   <a class='link' href="<?php echo \dash\url::kingdom(); ?>/enter/pass"><?php echo T_("Remembered your password?"); ?></a>
<?php
} // endif
?>
