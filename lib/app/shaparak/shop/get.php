<?php
namespace lib\app\shaparak\shop;


class get
{
	public static function my_first_shop()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$load = \lib\db\shaparak\shop\get::my_first_shop(\dash\user::id());

		$load = \lib\app\shaparak\shop\ready::row($load);

		return $load;
	}
}
?>