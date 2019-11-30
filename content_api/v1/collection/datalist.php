<?php
namespace content_api\v1\collection;


class datalist
{
	public static function route()
	{
		if(\dash\request::is('get'))
		{
			$result = self::list();
			\content_api\v1::say($result);
		}
		else
		{
			\content_api\v1::invalid_method();
		}
	}


	private static function list()
	{
		$detail = \lib\app\product\category::list();
		return $detail;
	}
}
?>