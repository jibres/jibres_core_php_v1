<?php
namespace content_a\product\factor;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productFactor');
		\content_a\product\load::product();
	}
}
?>
