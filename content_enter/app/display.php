<?php
if(\dash\user::id())
{
	if(\dash\user::detail('displayname') || \dash\user::detail('mobile'))
	{
		echo '<div class="msg success2 f fs08 txtC txtB" title='. T_("You"). '>';
		if(\dash\user::detail('displayname'))
		{
			echo '<span class="c12 s12">'. \dash\user::detail('displayname'). '</span><br>';
		}

		if(\dash\user::detail('mobile'))
		{
			echo '<span class="c12 s12">'.\dash\fit::mobile(\dash\user::detail('mobile')). '</span>';
		}
		echo '</div>';
	}
?>

<div class="btn warn block" data-confirm data-data='{"logoutapp": 1}' ><?php echo T_("Logout"); ?></div>

<?php
}
else
{

	\dash\csrf::html();
?>


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


  <div class='flex' id='ego'>
    <button type="submit"><?php echo T_("Go"); ?></button>
  </div>



<?php
} // endif
?>
