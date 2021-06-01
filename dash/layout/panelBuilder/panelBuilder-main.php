<div id='content' class='overflow-y-auto h-full'>
<?php
	if(\dash\data::include_adminPanelBuilder() === 'siteLivePreview')
	{
		require_once(core. 'layout/panelBuilder/panelBuilder-iframe.php');
	}
	else
	{
		require_once \dash\layout\func::display();
	}
?>
</div>