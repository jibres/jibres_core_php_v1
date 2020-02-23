<?php
namespace lib\app\nic_domain;


class edit
{
	public static function dns($_args, $_id)
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

		if(isset($load_domain['ns1']) && $load_domain['ns1'] == $ns1 && isset($load_domain['ns2']) && $load_domain['ns2'] == $ns2)
		{
			\dash\notif::info(T_("No change in your dns record"));
			return true;
		}

		$args =
		[
			'domain'  => $load_domain['name'],
			'old_ns1' => $load_domain['ns1'],
			'old_ns2' => $load_domain['ns2'],
			'new_ns1' => $ns1,
			'new_ns2' => $ns2,
		];

		$update_domian = \lib\nic\exec\domain_update::update($args);
		if(!$update_domian)
		{
			\dash\notif::error(T_("Can not update your domain detail now!"));
			return false;
		}

		$dns_id = \lib\app\nic_dns\add::quick($ns1, $ns2);
		if(!$dns_id)
		{
			return false;
		}

		$update_domian_record =
		[
			'dns' => $dns_id,
		];

		\lib\db\nic_domain\update::update($update_domian_record, $_id);
		\dash\notif::ok(T_("Domain detail updated"));
		return true;


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