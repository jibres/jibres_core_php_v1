<?php
namespace content_a\accounting\home;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');
	}
}
?>
