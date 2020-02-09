<?php
namespace lib\app\nic_domain;


class create
{
	public static function new_domain($_args)
	{
		$domain = isset($_args['domain']) 	? $_args['domain'] 	: null;
		$nic_id  = isset($_args['nic_id']) 	? $_args['nic_id'] 	: null;
		$period = isset($_args['period']) 	? $_args['period'] 	: null;
		$ns1    = isset($_args['ns1']) 		? $_args['ns1'] 	: null;
		$ns2    = isset($_args['ns2']) 		? $_args['ns2'] 	: null;
		$ns3    = isset($_args['ns3']) 		? $_args['ns3'] 	: null;
		$ns4    = isset($_args['ns4']) 		? $_args['ns4'] 	: null;
		$dnsid  = isset($_args['dnsid']) 	? $_args['dnsid'] 	: null;

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

		if($dnsid)
		{
			$load_dns = \lib\app\nic_dns\get::get($dnsid);

			if(!$load_dns)
			{
				return false;
			}

			$dnsid = \dash\coding::decode($dnsid);

			$ns1 = $load_dns['ns1'];
			$ns2 = $load_dns['ns2'];
		}
		else
		{
			\dash\notif::error(T_("Choose dns"));
			return false;
		}

		$ready =
		[
			'nic_id' => $nic_id,
			'domain' => $domain,
			'period' => $period_month,
			'ns1'    => $ns1,
			'ns2'    => $ns2,
		];

		$result = \lib\nic\exec\domain_create::create($ready);

		if(isset($result['name']))
		{
			$insert =
			[
				'user_id'      => \dash\user::id(),
				'name'         => $domain,
				'registrar'    => 'irnic',
				'status'       => 'enable',
				'holder'       => $nic_id,
				'admin'        => $nic_id,
				'tech'         => $nic_id,
				'bill'         => $nic_id,
				'autorenew'    => null,
				'lock'         => null,
				'dns'          => $dnsid,
				'dateregister' => $result['dateregister'],
				'dateexpire'   => $result['dateexpire'],
				'datecreated'  => date("Y-m-d H:i:s"),
			];

			$domain_id = \lib\db\nic_domain\insert::new_record($insert);
			if(!$domain_id)
			{
				// must be roolback money
				\dash\notif::error(T_("Error"));
				return false;
			}

			$insert_action =
			[
				'domain_id'   => $domain_id,
				'user_id'     => \dash\user::id(),
				'status'      => 'enable',
				'action'      => 'buy',
				'meta'        => null,
				'date'        => date("Y-m-d H:i:s"),
				'datecreated' => date("Y-m-d H:i:s"),
			];

			$domain_action_id = \lib\db\nic_domain_action\insert::new_record($insert_action);

			\dash\notif::ok(T_("Your domain was registred"));

			return true;

		}

	}
}
?>