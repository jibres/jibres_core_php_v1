<?php
namespace content_a\category\add;

class controller
{
	public static function routing()
	{
		\dash\permission::access('categoryAdd');


	}
}
?>