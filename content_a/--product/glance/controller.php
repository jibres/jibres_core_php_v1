<?php
namespace content_a\product\glance;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productGlance');
		\content_a\product\load::product();
	}
}
?>
