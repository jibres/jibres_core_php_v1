<?php
namespace lib\app\irvat;


class remove
{



	public static function remove($_id)
	{
		$load = \lib\app\irvat\get::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid irvat id"));
			return false;
		}


		\lib\db\irvats\delete::record($_id);

		\dash\notif::ok(T_("Fund successfully removed"));

		return true;
	}


}
?>