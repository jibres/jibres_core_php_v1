<?php
namespace lib\app\nic_domain;


class remove
{
	public static function remove($_id)
	{
		$_id = \dash\validate::code($_id);
		if(!$_id)
		{
			return false;
		}

		$_id = \dash\coding::decode($_id);

		$load_domain = \lib\app\nic_domain\get::by_id($_id);
		if(!$load_domain || !isset($load_domain['id']))
		{
			return false;
		}

		// if(isset($load_domain['status']) && $load_domain['status'] === 'disable')
		// {
		// 	// nothing
		// }
		// else
		// {
		// 	\dash\notif::error(T_("Can not edit this domain status"));
		// 	return false;
		// }

		\lib\app\domains\detect::domain('remove', $load_domain['name']);

		\lib\db\nic_domain\update::update(['status' => 'deleted'], $load_domain['id']);

		\dash\notif::ok(T_("Domain removed"));

		return true;

	}
}
?>