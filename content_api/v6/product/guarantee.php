<?php
namespace content_api\v6\product;


class guarantee
{
	public static function route()
	{
		if(\dash\request::is('get'))
		{
			return self::get_guarantee_list();
		}
		else
		{
			\content_api\v6::no(405);
		}
	}


	private static function get_guarantee_list()
	{
		$list = \lib\app\product\guarantee::list();
		return $list;
	}
}
?>