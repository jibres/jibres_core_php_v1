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

		$get_dns = \lib\app\business_domain\dns_broker::local_get($load['domain']);
		// $get_dns = \lib\app\business_domain\dns_broker::get($load['domain']);

		if(!$get_dns || !is_array($get_dns))
		{
			\dash\notif::error(T_("Can not get DNS detail!"));
			return false;
		}

		$dns = [];

		foreach ($get_dns as $key => $value)
		{
			if(isset($value['type']) && mb_strtolower($value['type']) === 'ns' && isset($value['target']))
			{
				$dns[] = $value['target'];
			}
		}

		\lib\app\business_domain\edit::set_date($_id, 'checkdns');
		\lib\app\business_domain\action::new_action($_id, 'checkdns', ['meta' => json_encode($dns)]);

		\dash\notif::ok(T_("DNS detail saved"));
		return true;
	}


	public static function get_count($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$count = \lib\db\business_domain\get::dns_count($id);

		return intval($count);
	}
}
?>