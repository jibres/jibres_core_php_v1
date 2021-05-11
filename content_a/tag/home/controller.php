<?php
namespace content_a\tag\home;

class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_products');
	}
}
?>