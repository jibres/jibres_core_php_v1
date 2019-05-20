<?php
namespace content_subdomain;


class view
{
	public static function config()
	{
		\dash\data::display_eStore("content_subdomain/theme_start/layout.html");

		\dash\data::include_js(false);
		\dash\data::include_css(false);
	}
}
?>