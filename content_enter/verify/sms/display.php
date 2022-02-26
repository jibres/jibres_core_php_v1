
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

<div class='flex fix' id='ecode'>
    <label for='code'>Code</label>
    <input id='code' name="code" type='number' placeholder='<?php echo T_("Verify Code"); ?>' autocomplete="off" inputmode="numeric" min="10000" max="99999" pattern="\d*" <?php \dash\layout\autofocus::html() ?> required>
   </div>


 <div class='flex' id='ego'>
    <button type="submit"><?php echo T_("Go"); ?></button>
   </div>


   <footer class='f'>

	<?php if(\dash\data::startNewMobile()) { ?>
		<a class="c link" href="<?php echo \dash\url::kingdom(); ?>/enter"><?php echo T_("Restart with new mobile"); ?></a>
	<?php }//endif ?>
  <?php if(!\dash\data::OnlyOneWay()) {?>
	<a class="link cauto" href="<?php echo \dash\url::here(); ?>/verify"><?php echo T_("Go back"); ?></a>
<?php } //endif ?>
   </footer>



