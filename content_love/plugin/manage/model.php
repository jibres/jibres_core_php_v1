<?php
namespace content_love\plugin\manage;


class model
{
	public static function post()
	{
		if(\dash\request::post('addplugin'))
		{
			$plugin     = \dash\request::post('plugin');
			$business_id = \dash\request::get('id');

			\lib\app\plugin\activate::add($business_id, $plugin);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		if(\dash\request::post('remove') === 'plugin')
		{
			$plugin     = \dash\request::post('plugin');
			$business_id = \dash\request::get('id');

			\lib\app\plugin\activate::remove($business_id, $plugin);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}



	}
}
?>
