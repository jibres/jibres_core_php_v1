<?php
namespace content_a\cats\home;

class controller
{
	public static function routing()
	{
		\dash\permission::access('categoryView');
	}
}
?>