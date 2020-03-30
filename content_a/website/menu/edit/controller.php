<?php
namespace content_a\website\menu\edit;


class controller
{
	public static function routing()
	{
		$menu_detail = \lib\app\website_menu\get::load_menu_edit();
		\dash\data::menuDetail($menu_detail);
	}
}
?>
