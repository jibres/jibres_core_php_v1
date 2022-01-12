<?php
namespace content_a\category\quickaccess;

class model
{
	public static function post()
	{
		if(\dash\request::post('addcategory'))
		{
			\lib\app\category\quickaccess::add(\dash\request::post('category'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		if(\dash\request::post('remove'))
		{
			\lib\app\category\quickaccess::remove(\dash\request::post('remove'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		if(\dash\request::post('setsort'))
		{
			\lib\app\category\quickaccess::set_sort(\dash\request::post('sort'));
		}
	}
}
?>