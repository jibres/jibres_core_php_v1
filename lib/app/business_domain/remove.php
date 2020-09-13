<?php
namespace lib\app\business_domain;

class remove
{
	public static function remove($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$id = $load['id'];

		\lib\db\business_domain\delete::all_domain_action($id);
		\lib\db\business_domain\delete::all_domain_dns($id);
		\lib\db\business_domain\delete::by_id($id);

		\dash\notif::delete(T_("Domain removed"));
		return true;
	}
}
?>