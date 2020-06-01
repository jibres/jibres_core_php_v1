<?php
namespace lib\app\fund;


class remove
{



	public static function remove($_id)
	{
		$load = \lib\app\fund\get::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid fund id"));
			return false;
		}


		\lib\db\funds\delete::record($_id);

		\dash\notif::ok(T_("Fund successfully removed"));

		return true;
	}


}
?>