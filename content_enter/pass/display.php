
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


       <div class='flex fix hide' id='epasscode'>
    <label for='passcode'>Pwd</label>
    <input id='passcode' name="password" type='password' placeholder='<?php echo T_("Password?"); ?>'  minlength="6" maxlength="40" <?php if(\dash\request::get('clean') || \dash\user::id()) { ?> autocomplete="new-password" <?php }else{ ?> autocomplete="off" <?php } // endif ?>>
   </div>

<?php \dash\utility\hive::html(); ?>
 <div class='flex fix' id='eramz'>
    <label for='ramz' title='<?php echo T_("Password"); ?>'>
      <i class="sf-lock"></i>
    </label>
    <input id='ramz' name="ramz" type='password' placeholder='<?php echo T_("Password"); ?>' autocomplete="off" minlength="6" maxlength="40" pattern=".{6,40}" autofocus required>
   </div>

     <div class='flex' id='elogin'>
    <button type="submit"><?php echo T_("Enter"); ?></button>
   </div>

   <a class="link" href="<?php echo \dash\url::kingdom(); ?>/enter/pass/recovery"><?php echo T_("Can't access your account?"); ?></a>

