<?php
namespace content_a\products\home;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_products');
	}
}
?>
