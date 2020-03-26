<?php
namespace content_a\website\header\customize;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Customize Website Headers'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		if(true) // check need to load menu
		{
			$menu = \lib\app\menu\get::list_all_menu();
			\dash\data::allMenu($menu);
		}



	}
}
?>
