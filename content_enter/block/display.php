<div class="text">
 <?php if(\dash\data::wafLimitTime()) {?>
 	<p class="mB0-f"><?php echo T_("Your account block will be expire until") ?>
 	<time class="block ltr txtL"><?php echo \dash\fit::date_time(date("Y-m-d H:i:s", \dash\data::wafLimitTime())); ?></time>
 	</p>
 <?php }else{ ?>
 	<p><?php echo T_("You are blocked becauese of some reason!"); ?></p>
 <?php } //endif ?>
 <p><?php echo T_("If have problem"); ?> <a href='<?php echo \dash\url::kingdom(); ?>/contact'><?php echo T_("Contact us"); ?></a></p>
</div>