<?php
namespace lib\app\onlinenic\log;


class get
{

	public static function by_id($_id)
	{
		$_id = \dash\validate::id($_id);
		if(!$_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\db\onlinenic_log\get::by_id($_id);

		if(!$load)
		{
			\dash\notif::error(T_("Domain not found"));
			return false;
		}

		$load = \lib\app\onlinenic\log\ready::row($load);

		return $load;

	}


	public static function group_by_type()
	{
		$list = \lib\db\onlinenic_log\get::group_by_type();
		return $list;
	}


	public static function group_by_code()
	{
		$list = \lib\db\onlinenic_log\get::group_by_code();
		return $list;
	}

}
?>