<?php
namespace content_a\accounting\factor;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');
	}
}
?>