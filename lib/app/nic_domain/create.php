<?php
namespace lib\app\nic_domain;


class create
{
	public static function new_domain($_args)
	{
		$domain = isset($_args['domain']) 	? $_args['domain'] 	: null;
		$irnic  = isset($_args['irnic']) 	? $_args['irnic'] 	: null;
		$period = isset($_args['period']) 	? $_args['period'] 	: null;
		$ns1    = isset($_args['ns1']) 		? $_args['ns1'] 	: null;
		$ns2    = isset($_args['ns2']) 		? $_args['ns2'] 	: null;
		$ns3    = isset($_args['ns3']) 		? $_args['ns3'] 	: null;
		$ns4    = isset($_args['ns4']) 		? $_args['ns4'] 	: null;

		if(!$domain)
		{
			\dash\notif::error(T_("Please set domain"));
			return false;
		}

		if(!\lib\app\nic_domain\check::syntax($domain))
		{
			\dash\notif::error(T_("Invalid domain syntax"));
			return false;
		}

		if(!in_array($period, ['1year', '5year']))
		{
			\dash\notif::error(T_("Invalid period"));
			return false;
		}

		$period_month = 0;

		if($period === '1year')
		{
			$period_month = 12;
		}
		elseif($period === '5year')
		{
			$period_month = 5*12;
		}

		if(!$ns1)
		{
			\dash\notif::error(T_("DNS #1 is required"), 'ns1');
			return false;
		}

		if(!$ns2)
		{
			\dash\notif::error(T_("DNS #2 is required"), 'ns2');
			return false;
		}

		if(mb_strlen($ns1) > 100)
		{
			\dash\notif::error(T_("DNS #1 is out of range"), 'ns1');
			return false;
		}

		if(mb_strlen($ns2) > 100)
		{
			\dash\notif::error(T_("DNS #2 is out of range"), 'ns2');
			return false;
		}


		if(!filter_var($ns1, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME))
		{
			\dash\notif::error(T_("DNS #1 is invalid"), 'ns1');
			return false;
		}

		if(!filter_var($ns2, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME))
		{
			\dash\notif::error(T_("DNS #2 is invalid"), 'ns2');
			return false;
		}

		$ready =
		[
			'domain' => $domain,
			'period' => $period_month,
			'ns1'    => $ns1,
			'ns2'    => $ns2,
		];

		$result = \lib\nic\exec\domain::create($ready);



	}
}
?>