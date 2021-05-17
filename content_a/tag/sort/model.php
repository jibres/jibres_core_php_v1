<?php
namespace content_a\tag\sort;

class model
{
	public static function post()
	{
		if(\dash\request::post('addtag'))
		{
			\lib\app\tag\add::first_level(\dash\request::post('tag'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		if(\dash\request::post('remove'))
		{
			\lib\app\tag\remove::first_level(\dash\request::post('remove'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		if(\dash\request::post('setsort'))
		{
			\lib\app\tag\edit::sort(\dash\request::post('sort'));
		}
	}
}
?>