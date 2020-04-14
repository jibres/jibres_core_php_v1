<div class="box">
	<header data-kerkere='#endpoints' data-kerkere-icon='open'><h2><?php echo T_("Endpoints"); ?></h2></header>
	<div class="body" id="endpoints">

	    <p><?php echo T_("The API is accessed by making HTTPS requests to a specific version endpoint URL, in which GET, POST, PUT, PATCH,HEAD and DELETE methods dictate how your interact with the information available."); ?> <?php echo T_("Every endpoint is accessed only via the HTTPS protocol."); ?></p>

	    <p><?php echo T_("Everything (methods, parameters, etc.) is fixed to a version number, and every call must contain one."); ?> <?php echo T_("The latest version is Version 1."); ?></p>

	    <p><?php echo T_("The stable base URL for all Version 2 HTTPS endpoints is"); ?></p>

	    <samp><?php echo \dash\data::CustomerApiURL(); ?></samp>

	    <?php if(!\dash\url::store()) {?>
	    <p class="mT10"><?php echo T_("Use your store code instead of the {STORE}"); ?> <?php echo T_("If you are registered and have store, you can obtain your {STORE} key from 'My Account' page."); ?> <a target="_blank" href="<?php echo \dash\url::kingdom(); ?>/account/appkey"><?php echo T_("Go to My account."); ?></a></p>
		<?php } //endif ?>

	</div>
</div>


