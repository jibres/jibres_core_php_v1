<?php
namespace content_my\business\start;


class controller
{
	public static function routing()
	{
		$can_add_new_store = \lib\app\store\add::can(true, false);

		\dash\data::canAddStore($can_add_new_store);

		\dash\csrf::set();

		\content_my\business\creating::access_step('start');
	}
}
?>