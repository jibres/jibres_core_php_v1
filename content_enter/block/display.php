
<div class="text">
 <p><?php echo T_("You are blocked becauese of some reason!"); ?></p>
 <?php if(\dash\request::get('e') && \dash\validate::datetime(\dash\request::get('e'), false)) {?>
 	<p><?php echo T_("Your account block will be expire until") ?>
 		<?php echo \dash\fit::date_time(\dash\request::get('e')); ?>
 	</p>
 <?php } //endif ?>
 <p><?php echo T_("If have problem"); ?> <a href='<?php echo \dash\url::kingdom(); ?>/contact'><?php echo T_("Contact us"); ?></a></p>
</div>


