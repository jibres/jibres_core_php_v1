<?php
namespace content_a\product\add;

class controller
{
	public static function routing()
	{
		\dash\permission::access('productAdd');
	}
}
?>