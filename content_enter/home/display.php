<?php
if(\dash\user::id())
{
?>


<div class="msg success2 f fs06" title='<?php echo T_("You"); ?>'>
	<span class="c"><?php echo \dash\user::detail('displayname'); ?></span>
	<span class="cauto"><?php echo \dash\fit::mobile(\dash\user::detail('mobile')); ?></span>
 </div>

<?php
} // endif

\dash\utility\hive::html();
?>


<div class='flex fix'>
    <input id='usernameormobile' name="usernameormobile" type='tel' data-disallowFaNum maxlength="15" placeholder='<?php echo T_("Mobile"); ?>' data-invalid='<?php echo T_("Please enter valid mobile or username or email number"); ?>' value="<?php echo \dash\data::getUsernamemobile(); ?>" data-pl-user='<?php echo T_("Username or Mobile or Email"); ?>' autocomplete="off" data-format='mobile-enter' required
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

 <div class='flex' id='ego'>
	<button type="submit"><?php echo T_("Go"); ?></button>
 </div>

 <div class="f" id='eMethods'>

<?php

$isUserNameClass = \dash\url::module() === 'username' ? 'active' : '';

if(\dash\url::module() === 'signup')
{
?>

<a href="<?php echo \dash\url::kingdom(); ?>/enter" id='ebusername' class="c <?php echo $isUserNameClass; ?>" title='<?php echo T_("Sign in instead"); ?>'>
      <i class="sf-user-5"></i>
     <span><?php echo T_("Login"); ?></span>
   </a>


<?php
}
else
{
?>


 <a href="<?php echo \dash\url::kingdom(); ?>/enter/signup" id='ebusername' class="c <?php echo $isUserNameClass; ?>" title='<?php echo T_("No account?"); ?> <?php echo T_("Create for yourself"); ?>'>
      <i class="sf-user-plus"></i>
     <span><?php echo T_("Create Account"); ?></span>
   </a>

<?php
} // endif
?>


  </div>
