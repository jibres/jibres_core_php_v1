<?php
namespace content_store;


class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);
		\dash\data::include_css(false);

		\dash\data::display_jibresControlLayout('content_store/layout.html');
	}
}
?>
