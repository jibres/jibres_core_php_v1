<?php
namespace content_a\accounting\doc\add;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');
	}
}
?>
