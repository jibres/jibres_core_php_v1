<?php
namespace content_pardakhtyar\write;

class view
{
	public static function config()
	{
		\dash\data::site_title(T_("PardakhtYar"). "  - ". "Test1");

		// we dont use js
		\dash\data::include_js(false);
		\dash\data::include_css(false);
	}
}
?>