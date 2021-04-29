<?php
namespace content_a\setting\menu\setting;


class model
{
	public static function post()
	{

		if(\dash\request::post('remove') === 'remove')
		{
			$theme_detail = \lib\app\menu\remove::remove(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/menu');
			}
		}

	}
}
?>
