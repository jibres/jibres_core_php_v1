<?php
namespace content_a\tag\sort;

class model
{
	public static function post()
	{
		if(\dash\request::post('setsort'))
		{
			\lib\app\tag\edit::sort(\dash\request::post('sort'));
		}
	}
}
?>