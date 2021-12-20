<?php
namespace content_a\products\groupediting;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_products');
	}
}
?>
