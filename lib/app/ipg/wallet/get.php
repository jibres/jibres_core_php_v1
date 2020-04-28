<?php
namespace lib\app\ipg\wallet;


class get
{
	public static function my_default_wallet()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$load = \lib\db\ipg\wallet\get::my_default_wallet(\dash\user::id());

		$load = \lib\app\ipg\wallet\ready::row($load);

		return $load;
	}


	public static function my_wallet()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$load = \lib\db\ipg\wallet\get::my_wallet(\dash\user::id());

		$load = array_map(['\\lib\\app\\ipg\\wallet\\ready', 'row'], $load);

		return $load;
	}
}
?>