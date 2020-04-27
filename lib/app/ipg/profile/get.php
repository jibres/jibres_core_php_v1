<?php
namespace lib\app\ipg\profile;


class get
{
	public static function my_profile()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$load = \lib\db\ipg\userdetail\get::my_detail(\dash\user::id());

		$load = \lib\app\ipg\profile\ready::row($load);

		return $load;
	}
}
?>