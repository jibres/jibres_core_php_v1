<?php
namespace content_b1\product\variant;


class model
{
	public static function post()
	{
		$get_variant = \content_b1\tools::input_body();

		if(!is_array($get_variant))
		{
			\dash\notif::error(T_("Variants must be array"));
			return false;
		}

		$result = \lib\app\product\variants::set_product($get_variant, \dash\request::get('id'));

		\content_b1\tools::say($result);
	}
}
?>