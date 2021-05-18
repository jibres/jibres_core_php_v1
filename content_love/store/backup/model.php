<?php
namespace content_love\store\backup;


class model
{
	public static function post()
	{
		if(\dash\request::post('backup') === 'backup')
		{
			\lib\app\store\backup::now(\dash\request::get('id'));
			\dash\redirect::pwd();
			return;
		}


		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\store\backup::remove(\dash\request::get('id'));
			\dash\redirect::pwd();
			return;
		}


	}
}
?>
