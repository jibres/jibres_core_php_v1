<?php
namespace content_api\v2\product;


class company
{
	public static function route()
	{
		if(\dash\request::is('get'))
		{
			return self::get_company_list();
		}
		else
		{
			\content_api\v2::stop(405);
		}
	}


	private static function get_company_list()
	{
		$list = \lib\app\product\company::list();
		return $list;
	}
}
?>