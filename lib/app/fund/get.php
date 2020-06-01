<?php
namespace lib\app\fund;


class get
{


	public static function inline_get($_id)
	{
		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid fund id"));
			return false;
		}

		$load = \lib\db\funds\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid fund id"));
			return false;
		}

		return $load;
	}


	public static function get($_id)
	{

		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid fund id"));
			return false;
		}

		$load = \lib\db\funds\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid fund id"));
			return false;
		}

		$load = \lib\app\fund\ready::row($load);
		return $load;
	}

}
?>