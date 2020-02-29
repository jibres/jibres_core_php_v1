<?php
namespace lib\app\nic_domain;


class create
{
	public static function new_domain($_args)
	{
		$domain      = isset($_args['domain']) 	? $_args['domain'] 	: null;
		$nic_id      = isset($_args['nic_id']) 	? $_args['nic_id'] 	: null;
		$period      = isset($_args['period']) 	? $_args['period'] 	: null;
		$ns1         = isset($_args['ns1']) 		? $_args['ns1'] 	: null;
		$ns2         = isset($_args['ns2']) 		? $_args['ns2'] 	: null;
		$ns3         = isset($_args['ns3']) 		? $_args['ns3'] 	: null;
		$ns4         = isset($_args['ns4']) 		? $_args['ns4'] 	: null;
		$dnsid       = isset($_args['dnsid']) 	? $_args['dnsid'] 	: null;

		$irnic_admin = isset($_args['irnic_admin']) 	? $_args['irnic_admin'] 	: null;
		$irnic_tech  = isset($_args['irnic_tech']) 	? $_args['irnic_tech'] 	: null;
		$irnic_bill  = isset($_args['irnic_bill']) 	? $_args['irnic_bill'] 	: null;

		if($irnic_admin && substr($irnic_admin, -6) !== '-irnic')
		{
			$irnic_admin = $irnic_admin. '-irnic';
		}

		if($irnic_tech && substr($irnic_tech, -6) !== '-irnic')
		{
			$irnic_tech = $irnic_tech. '-irnic';
		}

		if($irnic_bill && substr($irnic_bill, -6) !== '-irnic')
		{
			$irnic_bill = $irnic_bill. '-irnic';
		}


		$ip1 = null;
		$ip2 = null;
		$ip3 = null;
		$ip4 = null;

		$irnic_new = isset($_args['irnic_new']) 	? $_args['irnic_new'] 	: null;


		if(!$domain)
		{
			\dash\notif::error(T_("Please set domain"));
			return false;
		}

		if(!\lib\app\nic_domain\check::syntax($domain))
		{
			\dash\notif::warn('ssss');
			\dash\notif::error(T_("Invalid domain syntax"));
			return false;
		}

		if(!$period)
		{
			\dash\notif::error(T_("Please choose your period of register domain"));
			return false;
		}
		if(!in_array($period, ['1year', '5year']))
		{
			\dash\notif::error(T_("Invalid period"));
			return false;
		}

		$period_month = 0;
		$price = \lib\app\nic_domain\price::register($period);

		if($period === '1year')
		{
			$period_month = 12;
		}
		elseif($period === '5year')
		{
			$period_month = 5*12;
		}

		if(!$irnic_new && !$nic_id)
		{
			\dash\notif::error(T_("Please choose IRNIC handle"));
			return false;
		}


		if($irnic_new)
		{
			$add_quick_contact = \lib\app\nic_contact\add::quick($irnic_new);
			if(!$add_quick_contact)
			{
				return false;
			}

			$nic_id = $add_quick_contact;
		}
		else
		{
			$check_nic_id = \lib\db\nic_contact\get::user_nic_id(\dash\user::id(), $nic_id);
			if(!isset($check_nic_id['nic_id']))
			{
				\dash\notif::error(T_("IRNIC handle not fount in your list"));
				return false;
			}

			$nic_id = $check_nic_id['nic_id'];
		}





		$get_contac_nic =  \lib\nic\exec\contact_check::check($nic_id);
		if(!isset($get_contac_nic[$nic_id]))
		{
			\dash\notif::error(T_("Can not find  billing account detail of this domain"));
			return false;
		}

		if(!isset($get_contac_nic[$nic_id]))
		{
			\dash\notif::error(T_("Can not find  admin account detail of this domain"));
			return false;
		}

		if($irnic_bill)
		{
			$get_contac_nic_bill =  \lib\nic\exec\contact_check::check($irnic_bill);
			if(!isset($get_contac_nic_bill[$irnic_bill]))
			{
				\dash\notif::error(T_("Can not find  billing account detail of this domain"));
				return false;
			}

			if(!isset($get_contac_nic_bill[$irnic_bill]))
			{
				\dash\notif::error(T_("Can not find  admin account detail of this domain"));
				return false;
			}

			if(isset($get_contac_nic_bill[$irnic_bill]['bill']) && $get_contac_nic_bill[$irnic_bill]['bill'] == '1')
			{
				// no problem to register this domain by tihs contact
			}
			else
			{
				\dash\notif::error(T_("We can not register this domain because the bill holder of IRNIC can not access to register"));
				return false;
			}


		}
		else
		{

			if(isset($get_contac_nic[$nic_id]['bill']) && $get_contac_nic[$nic_id]['bill'] == '1')
			{
				// no problem to register this domain by tihs contact
			}
			else
			{
				\dash\notif::error(T_("We can not register this domain because the bill holder of IRNIC can not access to register"));
				return false;
			}

		}


		if($irnic_admin)
		{
			$get_contac_nic_admin =  \lib\nic\exec\contact_check::check($irnic_admin);
			if(!isset($get_contac_nic_admin[$irnic_admin]))
			{
				\dash\notif::error(T_("Can not find account detail of this domain"));
				return false;
			}

			if(!isset($get_contac_nic_admin[$irnic_admin]))
			{
				\dash\notif::error(T_("Can not find  admin account detail of this domain"));
				return false;
			}

			if(isset($get_contac_nic_admin[$irnic_admin]['admin']) && $get_contac_nic_admin[$irnic_admin]['admin'] == '1')
			{
				// no problem to register this domain by tihs contact
			}
			else
			{
				\dash\notif::error(T_("We can not register this domain because the admin holder of IRNIC can not access to register"));
				return false;
			}

		}
		else
		{
			if(isset($get_contac_nic[$nic_id]['admin']) && $get_contac_nic[$nic_id]['admin'] == '1')
			{
				// no problem to register this domain by tihs contact
			}
			else
			{
				\dash\notif::error(T_("We can not register this domain because the admin holder of IRNIC can not access to register"));
				return false;
			}
		}

		if($dnsid && $dnsid != 'something-else')
		{
			$load_dns = \lib\app\nic_dns\get::get($dnsid);

			if(!$load_dns)
			{
				return false;
			}

			$dnsid = \dash\coding::decode($dnsid);

			$ns1 = $load_dns['ns1'];
			$ns2 = $load_dns['ns2'];
			$ns3 = $load_dns['ns3'];
			$ns4 = $load_dns['ns4'];

			$ip1 = $load_dns['ip1'];
			$ip2 = $load_dns['ip2'];
			$ip3 = $load_dns['ip3'];
			$ip4 = $load_dns['ip4'];


		}
		else
		{
			if($ns1 && $ns2)
			{
				$get_ns_record = \lib\db\nic_dns\get::by_ns1_ns2(\dash\user::id(), $ns1, $ns2);
				if(!isset($get_ns_record['id']))
				{
					$dnsid = \lib\app\nic_dns\add::quick($ns1, $ns2);
					if(!$dnsid)
					{
						return false;
					}
				}
			}

		}

		if($dnsid == 'something-else')
		{
			$dnsid = null;
		}



		$check_duplicate_domain = \lib\db\nic_domain\get::domain_user($domain, \dash\user::id());
		if(isset($check_duplicate_domain['id']))
		{
			if(isset($check_duplicate_domain['status']))
			{
				switch ($check_duplicate_domain['status'])
				{
					case 'enable':
						\dash\notif::error(T_("This domain is already in your list"));
						return false;
						break;

					case 'expire':
					case 'disable':
					case 'deleted':
					case 'failed':
					case 'pending':
					case 'awiting':
					default:
						$domain_id = $check_duplicate_domain['id'];
						break;
				}
			}
			else
			{
				$domain_id = $check_duplicate_domain['id'];
			}
		}
		else
		{
			$insert =
			[
				'user_id'      => \dash\user::id(),
				'name'         => $domain,
				'registrar'    => 'irnic',
				'status'       => 'awaiting',
				'holder'       => $nic_id,
				'admin'        => $nic_id,
				'tech'         => $nic_id,
				'bill'         => $nic_id,
				'autorenew'    => 1,
				'lock'         => 1,
				'dns'          => $dnsid,
				'dateregister' => null,
				'dateexpire'   => null,
				'datecreated'  => date("Y-m-d H:i:s"),
			];

			$domain_id = \lib\db\nic_domain\insert::new_record($insert);

			if(!$domain_id)
			{
				// must be roolback money
				\dash\notif::error(T_("Error! Can not create your domain data"));
				return false;
			}
		}


		$domain_code = \dash\coding::encode($domain_id);
		\dash\temp::set('domain_code_url', $domain_code);

		$user_budget = \dash\user::budget();

		if($user_budget >= $price)
		{
			$insert_transaction =
			[
				'user_id' => \dash\user::id(),
				'title'   => T_("Buy domian :val", ['val' => $domain]),
				'verify'  => 1,
				'minus'   => $price,
				'type'    => 'money',
			];

			$transaction_id = \dash\db\transactions::set($insert_transaction);
			if(!$transaction_id)
			{
				\dash\notif::error(T_("No way to insert data"));
				return false;
			}

			// insert price domain log table
		}
		else
		{
			$temp_args = $_args;

			// go to bank
			$meta =
			[
				'msg_go'        => null,
				'auto_go'       => false,
				'auto_back'       => true,
				'turn_back'     => \dash\url::kingdom(). '/my/domain?resultid='. $domain_code,
				'user_id'       => \dash\user::id(),
				'amount'        => abs($price),
				'final_fn'      => ['/lib/app/nic_domain/create', 'new_domain'],
				'final_fn_args' => $temp_args,
			];

			\dash\utility\pay\start::site($meta);

			// redirect to bank payment
			return ;
		}


		$ready =
		[
			'nic_id' => $nic_id,
			'domain' => $domain,
			'period' => $period_month,
			'ns1'    => $ns1,
			'ns2'    => $ns2,
			'ns3'    => $ns3,
			'ns4'    => $ns4,

			'ip1'    => $ip1,
			'ip2'    => $ip2,
			'ip3'    => $ip3,
			'ip4'    => $ip4,

			'irnic_admin' => $irnic_admin,
			'irnic_tech' => $irnic_tech,
			'irnic_bill' => $irnic_bill,
		];


		// need to show result page
		\dash\temp::set('need_show_domain_result', true);

		$result = \lib\nic\exec\domain_create::create($ready);

		if(isset($result['name']))
		{
			$update =
			[
				'status'       => 'enable',
				'verify'       => 1,
				'dateregister' => $result['dateregister'],
				'dateexpire'   => $result['dateexpire'],
				'datecreated'  => date("Y-m-d H:i:s"),
			];

			\lib\db\nic_domain\update::update($update, $domain_id);



			$insert_action =
			[
				'domain_id'      => $domain_id,
				'user_id'        => \dash\user::id(),
				'status'         => 'enable', // 'enable', 'disable', 'deleted', 'expire'
				'action'         => 'register', // 'register', 'renew', 'transfer', 'openlock', 'lock', 'changedns', 'updateholder', 'delete', 'expire'
				'mode'           => 'manual', // 'auto', 'manual'
				'detail'         => null,
				'date'           => date("Y-m-d H:i:s"),
				'price'          => $price,
				'discount'       => null,
				'transaction_id' => $transaction_id,
				'datecreated'    => date("Y-m-d H:i:s"),
			];

			$domain_action_id = \lib\db\nic_domainaction\insert::new_record($insert_action);


			\dash\notif::ok(T_("Your domain was registred"));


			return true;

		}
		else
		{
			// have error
			// need to back money
			$insert_transaction =
			[
				'user_id' => \dash\user::id(),
				'title'   => T_("Register failed :val", ['val' => $domain]),
				'verify'  => 1,
				'plus'    => $price,
				'type'    => 'money',
			];

			$transaction_id = \dash\db\transactions::set($insert_transaction);
			if(!$transaction_id)
			{
				\dash\notif::error(T_("No way to insert data"));
				return false;
			}

			$update =
			[
				'status'       => 'failed',
			];

			\lib\db\nic_domain\update::update($update, $domain_id);

			\dash\notif::warn(T_("Can not register your domain, Money back to your account"));
		}

	}

}
?>