<?php
namespace lib\app\pos;


class remove
{

	public static function remove($_id)
	{
		$_id = \dash\validate::id($_id);
		if(!$_id)
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