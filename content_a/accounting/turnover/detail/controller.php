<?php
namespace content_a\accounting\turnover\detail;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');
	}
}
?>
