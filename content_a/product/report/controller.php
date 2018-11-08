<?php
namespace content_a\product\report;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productReport');
		\content_a\product\load::product();
	}
}
?>
