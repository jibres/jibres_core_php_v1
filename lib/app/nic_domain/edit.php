<?php
namespace lib\app\nic_domain;


class edit
{
	public static function domain($_args, $_id)
	{
		$load_domain = \lib\app\nic_domain\get::by_id($_id);
		if(!$load_domain || !isset($load_domain['id']))
		{
			return false;
		}

		$ns1   = isset($_args['ns1']) 	? $_args['ns1']		: null;
		$ip1   = isset($_args['ip1']) 	? $_args['ip1']		: null;

		$ns2   = isset($_args['ns2']) 	? $_args['ns2']		: null;
		$ip2   = isset($_args['ip2']) 	? $_args['ip2']		: null;

		$ns3   = isset($_args['ns3']) 	? $_args['ns3']		: null;
		$ip3   = isset($_args['ip3']) 	? $_args['ip3']		: null;

		$ns4   = isset($_args['ns4']) 	? $_args['ns4']		: null;
		$ip4   = isset($_args['ip4']) 	? $_args['ip4']		: null;


		$holder = isset($_args['holder']) 	? $_args['holder']		: null;
		$admin  = isset($_args['admin']) 	? $_args['admin']		: null;
		$tech   = isset($_args['tech']) 	? $_args['tech']		: null;
		$bill   = isset($_args['bill']) 	? $_args['bill']		: null;

		$ns1 = \lib\app\nic_dns\add::validate_ns($ns1, 'ns1');
		$ns2 = \lib\app\nic_dns\add::validate_ns($ns2, 'ns2');
		$ns3 = \lib\app\nic_dns\add::validate_ns($ns3, 'ns3');
		$ns4 = \lib\app\nic_dns\add::validate_ns($ns4, 'ns4');

		$ip1 = \lib\app\nic_dns\add::validate_ip($ip1, 'ip1');
		$ip2 = \lib\app\nic_dns\add::validate_ip($ip2, 'ip2');
		$ip3 = \lib\app\nic_dns\add::validate_ip($ip3, 'ip3');
		$ip4 = \lib\app\nic_dns\add::validate_ip($ip4, 'ip4');

		if(!\dash\engine\process::status())
		{
			return false;
		}

		if(!$ns1 || !$ns2)
		{
			\dash\notif::error(T_("DNS #1 and DNS #2 is required"), ['element' => ['ns1', 'ns2']]);
			return false;
		}

		$args = [];
		$update_domian_record = [];

		if(isset($load_domain['ns1']) && $load_domain['ns1'] == $ns1 && isset($load_domain['ns2']) && $load_domain['ns2'] == $ns2)
		{
			// no chaange in dns record
		}
		else
		{
			$args['old_ns1'] = $load_domain['ns1'];
			$args['old_ns2'] = $load_domain['ns2'];
			$args['new_ns1'] = $ns1;
			$args['new_ns2'] = $ns2;
		}

		if(isset($load_domain['holder']) && $load_domain['holder'] != $holder)
		{
			$args['holder']                 = $holder;
			$update_domian_record['holder'] = $holder;
		}

		if(isset($load_domain['admin']) && $load_domain['admin'] != $admin)
		{
			$args['admin']                 = $admin;
			$update_domian_record['admin'] = $admin;
		}

		if(isset($load_domain['tech']) && $load_domain['tech'] != $tech)
		{
			$args['tech']                 = $tech;
			$update_domian_record['tech'] = $tech;

		}

		if(isset($load_domain['bill']) && $load_domain['bill'] != $bill)
		{
			$args['bill']                 = $bill;
			$update_domian_record['bill'] = $bill;
		}

		if(empty($args))
		{
			\dash\notif::info(T_("No change in domain"));
			return true;
		}

		$args['domain']  = $load_domain['name'];

		$update_domian = \lib\nic\exec\domain_update::update($args);
		if(!$update_domian)
		{
			\dash\notif::error(T_("Can not update your domain detail now!"));
			return false;
		}

		if($ns1 && $ns2)
		{
			$dns_id = \lib\app\nic_dns\add::quick($ns1, $ns2);
			if(!$dns_id)
			{
				return false;
			}

			$update_domian_record['dns'] = $dns_id;
		}

		if(!empty($update_domian_record))
		{
			\lib\db\nic_domain\update::update($update_domian_record, $_id);
			\dash\notif::ok(T_("Domain detail updated"));
			return true;
		}
		else
		{
			\dash\notif::wan(T_("No change in you domain detail"));
			return true;
		}



	}


	public static function edit($_args, $_id)
	{
		$load_domain = \lib\app\nic_domain\get::by_id($_id);
		if(!$load_domain || !isset($load_domain['id']))
		{
			return false;
		}

		\dash\app::variable($_args);

		$args = \lib\app\nic_domain\check::variable();

		if(!$args || !\dash\engine\process::status())
		{
			return false;
		}


		if(!\dash\app::isset_request('autorenew')) unset($args['autorenew']);

		if(!empty($args))
		{
			\lib\db\nic_domain\update::update($args, $load_domain['id']);
		}

		\dash\notif::ok(T_("Detail updated"));
		return true;

	}
}
?>