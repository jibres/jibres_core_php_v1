<?php
namespace content_site\preview;


class view
{
	public static function config()
	{
		\dash\data::include_adminPanelBuilder('previewMode');
	}
}
?>