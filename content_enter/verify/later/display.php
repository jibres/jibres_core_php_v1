

<p class="msg glass"><?php echo T_("To do some action you must verify your account. If you could we ask you to verify your account now."); ?></p>


<a href="<?php echo \dash\url::this(); ?>" class="btn primary block" type="submit"><?php echo T_("Okay! Go verify"); ?></a>

<a class="link mT10 txtC " href="<?php echo \dash\url::pwd(); ?>" data-ajaxify data-method='post' data-data='{"force_signup" : true}'><?php echo T_("I want to verify later"); ?></a>


