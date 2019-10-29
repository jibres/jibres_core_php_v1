<?php
namespace content_a\product\stock;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productStock');
		\content_a\product\load::product();
	}
}
?>
