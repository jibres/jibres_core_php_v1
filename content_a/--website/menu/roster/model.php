<?php
namespace content_a\website\menu\roster;


class model
{
	public static function post()
	{
		if(\dash\request::post('setsort'))
		{
			\lib\app\menu\edit::sort(\dash\request::post('sort'), \dash\request::get('id'));
		}
	}
}
?>