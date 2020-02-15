

<div class='flex fix' id='emobile'>
    <label for='mobile'>
     <i class="sf-mobile"></i>
    </label>
    <input id='mobile' name="mobile" type='tel' maxlength="15" placeholder='<?php echo T_("Mobile"); ?>' data-invalid='<?php echo T_("Please enter valid mobile number"); ?>' value="<?php echo \dash\data::getMobile(); ?>" data-pl-user='<?php echo T_("Mobile"); ?>' autocomplete="off"  <?php if(\dash\language::current() === 'fa') { ?>pattern=".{10,14}" title='<?php echo T_("Enter correct iranian mobile starting with zero like 0935"); ?>' <?php }else{ ?> pattern=".{7,15}" title='<?php echo T_("Enter your mobile number"); ?>' <?php }//endif ?>  required  readonly >
   </div>


       <div class='flex fix hide' id='epasscode'>
    <label for='passcode'>Pwd</label>
    <input id='passcode' name="password" type='password' placeholder='<?php echo T_("Password?"); ?>'  minlength="6" maxlength="40" <?php if(\dash\request::get('clean') || \dash\user::id()) { ?> autocomplete="new-password" <?php }else{ ?> autocomplete="off" <?php } // endif ?>>
   </div>

     <div class='flex fix' id='eramzNew'>
    <label for='ramzNew'>**</label>
    <input id='ramzNew' name="ramzNew" type='password' placeholder='<?php echo T_("New Password"); ?>' autocomplete="off" minlength="6" maxlength="40" pattern=".{6,40}" title='<?php echo T_("Enter a password between 7 and 40 characters"); ?> <?php if(\dash\language::current() === 'fa') { ?><br><?php echo T_("Password is password."); ?><?php }//endif ?>' required>
   </div>

	<div class='flex' id='esignup'>
    <button type="submit"><?php echo T_("Sign Up"); ?></button>
   </div>
