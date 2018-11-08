<?php
namespace content_a\factor\home;


class controller
{
	public static function routing()
	{
		\dash\permission::access('factorAccess');
	}
}
?>
