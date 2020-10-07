<?php
namespace content_a\website\menu\sort;


class model
{
	public static function post()
	{
		$sort = \dash\request::post('sort');

		$theme_detail = \lib\app\website\menu\add::menu_item_sort($sort, \dash\request::get('id'));


		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>
