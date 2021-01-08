<?php
namespace content_a\website\menu\item;


class controller
{
	public static function routing()
	{
		$menu_detail = \lib\app\website\menu\get::load_menu_edit();

		if(array_key_exists('key', $_GET))
		{
			$key = \dash\request::get('key');

			if(isset($menu_detail['list'][$key]))
			{
				\dash\data::dataRow($menu_detail['list'][$key]);
				\dash\data::editMode(true);
			}
			else
			{
				\dash\header::status(404, T_("Invalid item key"));
			}

			\dash\data::itemkey($key);
		}

		\dash\data::menuDetail($menu_detail);

	}
}
?>
