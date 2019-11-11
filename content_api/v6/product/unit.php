<?php
namespace content_api\v6\product;


class unit
{
	public static function route()
	{
		if(\dash\request::is('get'))
		{
			return self::get_unit_list();
		}
		else
		{
			\content_api\v6::stop(405);
		}
	}


	private static function get_unit_list()
	{
		$list = \lib\app\product\unit::list();
		return $list;
	}
}
?>