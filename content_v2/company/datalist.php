<?php
namespace content_v2\company;


class datalist
{
	public static function route()
	{
		if(\dash\request::is('get'))
		{
			$result = self::list();
			\content_v2\tools::say($result);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}


	private static function list()
	{
		$detail = \lib\app\product\company::list();
		return $detail;
	}
}
?>