

<p><?php echo T_("You must confirm your mobile in the future"); ?></p>


<a href="<?php echo \dash\url::this(); ?>" class="btn primary block" type="submit"><?php echo T_("Verify now"); ?></a>

<a class="link mT20 txtC " href="<?php echo \dash\url::pwd(); ?>" data-ajaxify data-method='post' data-data='{"force_signup" : true}'><?php echo T_("Verify later"); ?></a>



   <footer class='f'>

	<?php if(\dash\data::startNewMobile()) { ?>
		<a class="c" href="<?php echo \dash\url::kingdom(); ?>/enter"><?php echo T_("Restart with new mobile"); ?></a>
	<?php }//endif ?>

	<a class="link cauto" href="<?php echo \dash\url::here(); ?>/verify"><?php echo T_("Go back"); ?></a>
   </footer>

