

<div class='flex fix'>
    <label for='codex'>Code</label>
    <input id='codex' name="codex" type='password' placeholder='<?php echo T_("Verify Code"); ?>' autocomplete="off"  autofocus required>
   </div>


 <div class='flex' id='ego'>
    <button type="submit"><?php echo T_("Go"); ?></button>
   </div>




   <footer class='f'>

	<?php if(\dash\data::startNewMobile()) { ?>
		<a class="c" href="<?php echo \dash\url::kingdom(); ?>/enter"><?php echo T_("Restart with new mobile"); ?></a>
	<?php }//endif ?>

	<a class="link cauto" href="<?php echo \dash\url::here(); ?>/verify"><?php echo T_("Go back"); ?></a>
   </footer>



