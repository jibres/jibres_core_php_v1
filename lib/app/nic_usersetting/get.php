<?php
namespace lib\app\nic_usersetting;


class get
{

	public static function get()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$get = \lib\db\nic_usersetting\get::my_setting(\dash\user::id());

		return $get;
	}
}
?>