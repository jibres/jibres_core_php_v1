<?php
namespace lib\app\shaparak\gateway;


class get
{
	public static function my_first_gateway()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$load = \lib\db\shaparak\gateway\get::my_first_gateway(\dash\user::id());

		$load = \lib\app\shaparak\gateway\ready::row($load);

		return $load;
	}
}
?>