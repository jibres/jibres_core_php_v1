<?php
namespace lib\app\business_domain;


class get
{
	public static function get($_id)
	{

		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$load = \lib\db\business_domain\get::by_id($id);

		if(!$load)
		{
			\dash\notif::error(T_("Domain detail not found"));
			return false;
		}

		$load = \lib\app\business_domain\ready::row($load);

		return $load;
	}
}
?>