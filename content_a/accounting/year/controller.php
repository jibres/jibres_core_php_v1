<?php
namespace content_a\accounting\year;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');
	}
}
?>
