<?php
namespace lib\app\shaparak\profile;


class get
{
	public static function my_profile()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$load = \lib\db\shaparak\customer\get::my_detail(\dash\user::id());

		$load = \lib\app\shaparak\profile\ready::row($load);

		return $load;
	}
}
?>