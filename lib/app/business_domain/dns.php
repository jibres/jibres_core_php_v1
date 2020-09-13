<?php
namespace lib\app\business_domain;

class dns
{
	public static function check($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);
		if(!$load || !isset($load['domain']))
		{
			return false;
		}

		// $get_dns = \lib\app\business_domain\dns_broker::local_get($load['domain']);
		$get_dns = \lib\app\business_domain\dns_broker::get($load['domain']);

		if(!$get_dns || !is_array($get_dns))
		{
			\dash\notif::error(T_("Can not get DNS detail!"));
			return false;
		}


		var_dump($get_dns);
		var_dump($load);exit();

		\dash\notif::error(T_($_id));
	}
}
?>