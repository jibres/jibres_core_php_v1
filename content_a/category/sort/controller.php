<?php
namespace content_a\category\sort;

class controller
{
	public static function routing()
	{
		\dash\permission::access('categoryView');
	}
}
?>