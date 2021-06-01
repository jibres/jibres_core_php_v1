<div id='content' class='scr'>
<?php
	if(\dash\data::include_adminPanelBuilder() === 'siteBuilder')
	{
		require_once(core. 'layout/panelBuilder/panelBuilder-iframe.php');
	}
	else
	{
		require_once \dash\layout\func::display();
	}
?>
</div>