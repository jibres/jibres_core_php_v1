
<div class="f justify-center">
	<div class="c8 s12">
		<?php if(!\dash\user::id()) {?>
			<div class="msg fs18 txtC warn">
			  <a href="<?php echo \dash\url::kingdom(); ?>/enter?referer=<?php echo \dash\url::current(); ?>"><?php echo T_("Please log in if you need to store this ticket and track it in the future"); ?></a>
			</div>
		<?php } //endif ?>

		<?php require_once( __DIR__. '/../addForm.php'); ?>

	</div>
</div>


