<?php
namespace lib\app\pos;


class remove
{

	public static function remove($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		if(!\lib\db\pos\delete::record($_id))
		{
			\dash\notif::error(T_("This pos not found in your store"));
			return false;
		}
		else
		{
			\dash\notif::ok(T_("Pos removed"));
			return true;
		}
	}
}
?>