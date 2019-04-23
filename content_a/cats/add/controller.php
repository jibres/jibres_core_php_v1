<?php
namespace content_a\cats\add;

class controller
{
	public static function routing()
	{
		\dash\permission::access('categoryAdd');


	}
}
?>