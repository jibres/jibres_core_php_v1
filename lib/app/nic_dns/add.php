<?php
namespace lib\app\nic_dns;


class add
{
	public static function new_record($_args)
	{

		$title = isset($_args['title']) ? $_args['title']	: null;

		$ns1   = isset($_args['ns1']) 	? $_args['ns1']		: null;
		$ip1   = isset($_args['ip1']) 	? $_args['ip1']		: null;

		$ns2   = isset($_args['ns2']) 	? $_args['ns2']		: null;
		$ip2   = isset($_args['ip2']) 	? $_args['ip2']		: null;

		$ns3   = isset($_args['ns3']) 	? $_args['ns3']		: null;
		$ip3   = isset($_args['ip3']) 	? $_args['ip3']		: null;

		$ns4   = isset($_args['ns4']) 	? $_args['ns4']		: null;
		$ip4   = isset($_args['ip4']) 	? $_args['ip4']		: null;

		if($title && mb_strlen($title) >= 200)
		{
			\dash\notif::error(T_("title must be lessh than 200 character"), 'title');
			return false;
		}

		$ns1 = self::validate_ns($ns1, 'ns1');
		$ns2 = self::validate_ns($ns2, 'ns2');
		$ns3 = self::validate_ns($ns3, 'ns3');
		$ns4 = self::validate_ns($ns4, 'ns4');

		$ip1 = self::validate_ip($ip1, 'ip1');
		$ip2 = self::validate_ip($ip2, 'ip2');
		$ip3 = self::validate_ip($ip3, 'ip3');
		$ip4 = self::validate_ip($ip4, 'ip4');

		if(!\dash\engine\process::status())
		{
			return false;
		}


		$insert =
		[
			'user_id'     => \dash\user::id(),
			'title'       => $title,
			'ns1'         => $ns1,
			'ip1'         => $ip1,
			'ns2'         => $ns2,
			'ip2'         => $ip2,
			'ns3'         => $ns3,
			'ip3'         => $ip3,
			'ns4'         => $ns4,
			'ip4'         => $ip4,
			'isdefault'   => null,
			'status'      => 'enable',
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$dns_id = \lib\db\nic_dns\insert::new_record($insert);
		if(!$dns_id)
		{
			\dash\notif::error(T_("No way to insert dns"));
		}

		return true;


	}


	private static function validate_ip($_ip, $_element)
	{
		if(mb_strlen($_ip) >= 100)
		{
			\dash\notif::error(T_("IP must be less than 100 character"), $_element);
			return false;
		}

		return $_ip;
	}


	private static function validate_ns($_ns, $_element)
	{
		if(mb_strlen($_ns) >= 100)
		{
			\dash\notif::error(T_("DNS must be less than 100 character"), $_element);
			return false;
		}

		return $_ns;
	}
}
?>