<h2 class="f" data-kerkere='#endpoints-detail' data-kerkere-icon='open'><?php echo T_("Endpoints"); ?></h2>
<div id="endpoints-detail">
	<div class="cbox fs15" id='endpoints'>

    <p><?php echo T_("The API is accessed by making HTTPS requests to a specific version endpoint URL, in which GET, POST, PUT, PATCH,HEAD and DELETE methods dictate how your interact with the information available."); ?> <?php echo T_("Every endpoint is accessed only via the HTTPS protocol."); ?></p>

    <p><?php echo T_("Everything (methods, parameters, etc.) is fixed to a version number, and every call must contain one."); ?> <?php echo T_("The latest version is Version 10."); ?></p>

    <p><?php echo T_("The stable base URL for all Version 10 HTTPS endpoints is"); ?></p>

    <samp><?php echo \dash\data::IRNICApiURL(); ?></samp>

  </div>
</div>
