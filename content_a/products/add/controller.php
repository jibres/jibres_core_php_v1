<?php
namespace content_a\products\add;


class controller
{
	public static function routing()
	{
		\dash\permission::access('ProductAdd');
	}
}
?>