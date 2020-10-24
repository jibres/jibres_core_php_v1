<?php
namespace content_a\form\tag\add;

class controller
{
	public static function routing()
	{
		\dash\permission::access('tagAdd');


	}
}
?>