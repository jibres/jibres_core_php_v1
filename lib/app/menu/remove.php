<?php
namespace lib\app\menu;


class remove
{
	public static function remove($_id)
	{
		\dash\permission::access('_group_setting');

		$load = \lib\app\menu\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}


		\lib\db\menu\delete::remove_menu($load['id']);

		\dash\notif::ok(T_("Menu removed"));
		return true;
	}
}
?>