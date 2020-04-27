<?php
namespace lib\app\ipg\gateway;


class get
{
	public static function my_first_gateway()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$load = \lib\db\ipg\gateway\get::my_first_gateway(\dash\user::id());

		$load = \lib\app\ipg\gateway\ready::row($load);

		return $load;
	}
}
?>