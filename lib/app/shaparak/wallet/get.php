<?php
namespace lib\app\shaparak\wallet;


class get
{
	public static function my_default_wallet()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$load = \lib\db\shaparak\wallet\get::my_default_wallet(\dash\user::id());

		$load = \lib\app\shaparak\wallet\ready::row($load);

		return $load;
	}


	public static function my_wallet()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$load = \lib\db\shaparak\wallet\get::my_wallet(\dash\user::id());

		$load = array_map(['\\lib\\app\\shaparak\\wallet\\ready', 'row'], $load);

		return $load;
	}
}
?>