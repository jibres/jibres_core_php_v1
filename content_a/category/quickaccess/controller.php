<?php
namespace content_a\category\quickaccess;

class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_products');
	}
}
?>