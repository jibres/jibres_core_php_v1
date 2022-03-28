<?php
namespace content_a\setting\menu;



class view
{
	public static function config()
	{
		\dash\face::title(T_('Menu list'));

		// back
		\dash\data::back_text(T_('Website Builder'));
		\dash\data::back_link(\dash\url::kingdom(). '/site');
		// \dash\data::back_direct(true);

		\dash\data::action_text(T_('Add new menu'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::this(). '/menu/add');

		$menu_list = \lib\app\menu\get::list_all_menu();
		\dash\data::menuList($menu_list);

	}
}
?>
