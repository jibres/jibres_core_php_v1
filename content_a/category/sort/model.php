<?php
namespace content_a\category\sort;

class model
{
	public static function post()
	{
		if(\dash\request::post('addtag'))
		{
			\lib\app\category\add::first_level(\dash\request::post('tag'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		if(\dash\request::post('remove'))
		{
			\lib\app\category\remove::first_level(\dash\request::post('remove'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		if(\dash\request::post('setsort'))
		{
			\lib\app\category\edit::sort(\dash\request::post('sort'));
		}
	}
}
?>