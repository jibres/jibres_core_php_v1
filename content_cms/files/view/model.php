<?php
namespace content_cms\files\view;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\dash\app\files\remove::remove(\dash\request::get('id'), true);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this().'/datalist');
			}
		}
	}
}
?>
