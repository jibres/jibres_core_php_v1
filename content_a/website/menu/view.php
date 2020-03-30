<?php
namespace content_a\website\menu;



class view
{
	public static function config()
	{
		\dash\face::title(T_('Menu setting'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$menu_list = \lib\app\website_menu\get::list_all_menu();
		\dash\data::menuList($menu_list);
	}
}
?>
