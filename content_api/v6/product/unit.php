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
			\content_api\v6::no(405);
		}
	}


	private static function get_unit_list()
	{
		j('fsdfd');
	}
}
?>