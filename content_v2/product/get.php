<?php
namespace content_v2\product;


class get
{
	public static function route($_product_id)
	{
		if(\dash\request::is('get'))
		{
			$result = self::get_one($_product_id);
			\content_v2\tools::say($result);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}


	private static function get_one($_product_id)
	{
		$detail = \lib\app\product\load::one($_product_id);
		return $detail;
	}
}
?>