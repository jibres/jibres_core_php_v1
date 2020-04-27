<?php
namespace lib\app\ipg\iban;


class get
{
	public static function my_default_iban()
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$load = \lib\db\ipg\iban\get::my_default_iban(\dash\user::id());

		$load = \lib\app\ipg\iban\ready::row($load);

		return $load;
	}
}
?>