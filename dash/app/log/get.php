<?php
namespace dash\app\log;


class get
{


	public static function get($_id)
	{
		$load = \dash\db\logs\get::by_id($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Log not founded"));
			return false;
		}

		$load = \dash\app\log\ready::row($load);
		return $load;


	}


	public static function get_notif($_id)
	{
		$load = \dash\db\logs\get::notif_by_id($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Log not founded"));
			return false;
		}

		$load = \dash\app\log\ready::row($load);
		return $load;


	}


}
?>