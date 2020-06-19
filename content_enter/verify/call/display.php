
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

	<a class="link cauto" href="<?php echo \dash\url::here(); ?>/verify"><?php echo T_("Go back"); ?></a>
   </footer>



