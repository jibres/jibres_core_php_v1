<?php
namespace content_a\website\menu\setting;


class model
{
	public static function post()
	{

		if(\dash\request::post('remove') === 'remove')
		{
			$post =
			[
				'removemenu'    => \dash\request::get('id'),
			];

			$theme_detail = \lib\app\website\menu\add::remove_menu($post);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/menu');
			}
		}

	}
}
?>
