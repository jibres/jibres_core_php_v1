<?php
namespace content_a\website\menu\edit;


class model
{
	public static function post()
	{

		if(\dash\request::post('editmenu') === 'editmenu')
		{
			$post =
			[
				'title'    => \dash\request::post('menutitle'),
			];

			$theme_detail = \lib\app\website\menu\edit::edit_menu($post, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}
		elseif(\dash\request::post('removemenu') === 'removemenu')
		{

			$post =
			[
				'removemenu'    => \dash\request::post('menuid'),
			];

			$theme_detail = \lib\app\website\menu\add::remove_menu($post);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/menu');
			}
		}
		else
		{

			$post =
			[
				'title'   => \dash\request::post('title'),
				'url'     => \dash\request::post('url'),
				'target'  => \dash\request::post('target'),
				'sort'    => \dash\request::post('sort'),
				'itemkey' => \dash\request::post('itemkey'),
				'remove'  => \dash\request::post('remove'),
			];

			$theme_detail = \lib\app\website\menu\add::menu_item($post, \dash\request::get('id'));


			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>
