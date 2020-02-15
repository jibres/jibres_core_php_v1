
 <div class='flex fix'>
    <input id='usernameormobile' name="usernameormobile" type='tel' data-disallowFaNum maxlength="15" placeholder='<?php echo T_("Mobile"); ?>' data-invalid='<?php echo T_("Please enter valid mobile or username or email number"); ?>' value="<?php echo \dash\data::getUsernamemobile(); ?>" data-pl-user='<?php echo T_("Username or Mobile or Email"); ?>' autocomplete="off" required readonly  title='<?php echo T_("Username or Mobile or email"); ?>'>
   </div>

    <div class='flex fix hide' id='epasscode'>
    <label for='passcode'>Pwd</label>
    <input id='passcode' name="password" type='password' placeholder='<?php echo T_("Password?"); ?>'  minlength="6" maxlength="40" <?php if(\dash\request::get('clean') || \dash\user::id()) { ?> autocomplete="new-password" <?php }else{ ?> autocomplete="off" <?php } // endif ?>>
   </div>

     <div class='flex fix' id='eramzNew'>
    <label for='ramzNew'>**</label>
    <input id='ramzNew' name="ramzNew" type='password' placeholder='<?php echo T_("New Password"); ?>' autocomplete="off" minlength="6" maxlength="40" pattern=".{6,40}" title='<?php echo T_("Enter a password between 7 and 40 characters"); ?> <?php if(\dash\language::current() === 'fa') { ?><br><?php echo T_("Password is password."); ?><?php }//endif ?>' required>
   </div>

   <div class='flex' id='erecovery'>
    <button type="submit"><?php echo T_("Recovery password"); ?></button>
   </div>

   <a class='link' href="<?php echo \dash\url::kingdom(); ?>/enter/pass"><?php echo T_("Remembered your password?"); ?></a>

