<?php
namespace content_a\tag\add;

class controller
{
	public static function routing()
	{
		\dash\permission::access('tagAdd');


	}
}
?>