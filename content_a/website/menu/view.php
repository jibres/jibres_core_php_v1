<?php
namespace content_a\website\menu;



class view
{
	public static function config()
	{
		\dash\face::title(T_('Menu list'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::action_text(T_('Add new menu'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::this(). '/menu/add');

		$menu_list = \lib\app\website\menu\get::list_all_menu();
		\dash\data::menuList($menu_list);

		if(!$menu_list)
		{
			\dash\redirect::to(\dash\url::this(). '/menu/add');
		}
	}
}
?>
