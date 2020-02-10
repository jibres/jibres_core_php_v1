<?php
namespace lib\app\nic_dns;


class edit
{
	public static function edit($_args, $_id)
	{
		$load = \lib\app\nic_dns\get::get($_id);
		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$title = isset($_args['title']) ? $_args['title']	: null;

		$ns1   = isset($_args['ns1']) 	? $_args['ns1']		: null;
		$ip1   = isset($_args['ip1']) 	? $_args['ip1']		: null;

		$ns2   = isset($_args['ns2']) 	? $_args['ns2']		: null;
		$ip2   = isset($_args['ip2']) 	? $_args['ip2']		: null;

		$ns3   = isset($_args['ns3']) 	? $_args['ns3']		: null;
		$ip3   = isset($_args['ip3']) 	? $_args['ip3']		: null;

		$ns4   = isset($_args['ns4']) 	? $_args['ns4']		: null;
		$ip4   = isset($_args['ip4']) 	? $_args['ip4']		: null;

		$isdefault = isset($_args['isdefault']) 	? $_args['isdefault']		: null;
		$isdefault = $isdefault ? 1 : null;

		if($title && mb_strlen($title) >= 100)
		{
			\dash\notif::error(T_("title must be lessh than 100 character"), 'title');
			return false;
		}

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

		if($isdefault)
		{
			\lib\db\nic_dns\update::remove_old_default(\dash\user::id());
		}


		$update =
		[
			'title'       => $title,
			'ns1'         => $ns1,
			'ip1'         => $ip1,
			'ns2'         => $ns2,
			'ip2'         => $ip2,
			'ns3'         => $ns3,
			'ip3'         => $ip3,
			'ns4'         => $ns4,
			'ip4'         => $ip4,
			'isdefault'   => $isdefault,
			'status'      => 'enable',
		];

		$update_dns = \lib\db\nic_dns\update::update($update, $load['id']);
		if($update_dns)
		{
			\dash\notif::ok(T_("DNS record successfully updated"));
			return true;
		}

		\dash\notif::error(T_("No way to update dns"));
		return false;

	}
}
?>