<?php
namespace content_a\website\menu\add;



class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new menu'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/menu');

		// if have not any menu must back to dashboard
		$menu_list = \lib\app\website\menu\get::list_all_menu();
		if(!$menu_list)
		{
			\dash\data::back_link(\dash\url::this());
		}

	}
}
?>
