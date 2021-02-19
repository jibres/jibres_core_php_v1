<?php
namespace content_my\business\start;


class controller
{
	public static function routing()
	{
		$can_add_new_store = \lib\app\store\add::can2(true, false);
		\dash\data::canAddStore($can_add_new_store);
	}
}
?>
