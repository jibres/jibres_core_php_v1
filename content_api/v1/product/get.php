<?php
namespace content_api\v1\product;


class get
{
	public static function route($_product_id)
	{
		if(\dash\request::is('get'))
		{
			$result = self::get_one($_product_id);
			\content_api\v1\tools::say($result);
		}
		else
		{
			\content_api\v1\tools::invalid_method();
		}
	}


	private static function get_one($_product_id)
	{
		$detail = \lib\app\product\load::one($_product_id);
		return $detail;
	}
}
?>