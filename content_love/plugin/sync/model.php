<?php
namespace content_love\plugin\sync;


class model
{
	public static function post()
	{
		if(\dash\request::post('sync') === 'sync')
		{
			\lib\app\plugin\activate::sync_all_business();

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}





	}
}
?>
