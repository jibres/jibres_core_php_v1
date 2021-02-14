<?php
namespace content_a\form\answer\export;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\form\answer\export::remove(\dash\request::post('id'));
		}
		else
		{
			\lib\app\form\answer\export::queue(\dash\request::get('id'));
		}
		\dash\redirect::pwd();
	}
}
?>
