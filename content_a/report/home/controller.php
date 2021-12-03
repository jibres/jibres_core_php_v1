<?php
namespace content_a\report\home;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_setting');
		// \dash\redirect::to(\dash\url::here().'/report/products');
	}
}
?>
