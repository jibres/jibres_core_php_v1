<?php
namespace content_a\report;


class controller
{
	public static function routing()
	{
		\dash\redirect::to(\dash\url::here().'/report/products');
	}
}
?>
