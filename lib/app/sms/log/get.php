<?php
namespace lib\app\sms\log;


class get
{
	public static function get($_id)
	{
		$id = \dash\validate::id($_id);

		$load = \lib\db\sms_log\get::by_id($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Log not founded"));
			return false;
		}

		$load = \lib\app\sms\log\ready::row($load);

		return $load;
	}
}
?>