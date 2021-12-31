<?php
namespace content_a\order\home;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_orders');

		\lib\app\order\next_prev::detect_next_prev();
	}
}
?>
