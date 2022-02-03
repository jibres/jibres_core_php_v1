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

		if(a($load, 'key'))
		{
			\dash\db\users\update::remove_old_permission($load['key']);
		}

		\lib\db\setting\delete::record($_id);

		\dash\notif::ok(T_("Permission removed"));
		return true;

	}
}
?>
