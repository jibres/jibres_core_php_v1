<?php
namespace lib\app\nic_dns;


class search
{
	public static function my_list()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$list = \lib\db\nic_dns\get::user_list(\dash\user::id());

		return $list;

	}
}
?>