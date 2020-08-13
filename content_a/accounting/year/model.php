<?php
namespace content_a\accounting\year;


class model
{
	public static function post()
	{
		if(\dash\request::post('setdefault') === 'setdefault')
		{
			\lib\app\tax\year\edit::set_default(\dash\request::post('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}
	}
}
?>
