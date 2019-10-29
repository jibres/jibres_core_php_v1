<?php
namespace content_a\product\variants;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productVariants');
		\content_a\product\load::product();
	}
}
?>
