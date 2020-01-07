<?php
namespace lib\app\pos;


class tools
{
	public static function default($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$get = \lib\db\pos\get::by_id($_id);
		if(!$get)
		{
			\dash\notif::error(T_("Pos detail not found"));
			return false;
		}

		\lib\db\pos\update::set_default($_id);
		return true;
	}
}
?>