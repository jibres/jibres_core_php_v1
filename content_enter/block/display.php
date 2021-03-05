
<div class="text">
 <?php if(\dash\request::get('e') && \dash\validate::datetime(\dash\request::get('e'), false)) {?>
 	<p class="mB0-f"><?php echo T_("Your account block will be expire until") ?>
 	<time class="block ltr txtL"><?php echo \dash\fit::date_time(\dash\request::get('e')); ?></time>
 	</p>
 <?php } //endif ?>
 <p><?php echo T_("If have problem"); ?> <a href='<?php echo \dash\url::kingdom(); ?>/contact'><?php echo T_("Contact us"); ?></a></p>
</div>


