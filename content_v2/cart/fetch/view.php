<?php
namespace content_v2\cart\fetch;


class view
{
	public static function config()
	{
		$result  = \lib\app\cart\get::my_cart_list();
		\content_v2\tools::say($result);
	}

}
?>