<?php
namespace lib\app\irvat;


class get
{


	public static function inline_get($_id)
	{
		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid irvat id"));
			return false;
		}

		$load = \lib\db\irvat\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid irvat id"));
			return false;
		}

		return $load;
	}


	public static function get($_id)
	{

		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid irvat id"));
			return false;
		}

		$load = \lib\db\irvat\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid irvat id"));
			return false;
		}

		$load = \lib\app\irvat\ready::row($load);
		return $load;
	}

}
?>