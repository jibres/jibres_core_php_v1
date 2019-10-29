<?php
namespace content_a\product\property;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productPropertyEdit');
		\content_a\product\load::product();
	}
}
?>
