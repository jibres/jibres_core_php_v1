<?php
namespace content_v2\collection;


class get
{
	public static function route($_category_id)
	{
		if(\dash\request::is('get'))
		{
			$result = self::get_one($_category_id);
			\content_v2\tools::say($result);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}


	private static function get_one($_category_id)
	{
		$detail = \lib\app\category\load::one($_category_id);
		return $detail;
	}
}
?>