<?php
namespace content_a\website\menu\sort;


class controller
{
	public static function routing()
	{
		$menu_detail = \lib\app\website\menu\get::load_menu_edit();
		\dash\data::menuDetail($menu_detail);
	}
}
?>
