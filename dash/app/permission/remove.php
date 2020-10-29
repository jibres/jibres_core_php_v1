<?php
namespace dash\app\permission;


class remove
{
	public static function remove($_id)
	{

		$load = \dash\app\permission\get::get($_id);
		if(!$load)
		{
			return false;
		}

		// check user count

		\lib\db\setting\delete::record($_id);

		\dash\notif::ok(T_("Permission removed"));
		return true;

	}
}
?>
