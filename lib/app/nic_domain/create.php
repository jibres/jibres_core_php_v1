<?php
namespace lib\app\nic_domain;


class create
{
	public static function new_domain($_args)
	{
		$domain = isset($_args['domain']) 	? $_args['domain'] 	: null;
		$nic_id = isset($_args['nic_id']) 	? $_args['nic_id'] 	: null;
		$period = isset($_args['period']) 	? $_args['period'] 	: null;
		$ns1    = isset($_args['ns1']) 		? $_args['ns1'] 	: null;
		$ns2    = isset($_args['ns2']) 		? $_args['ns2'] 	: null;
		$ns3    = isset($_args['ns3']) 		? $_args['ns3'] 	: null;
		$ns4    = isset($_args['ns4']) 		? $_args['ns4'] 	: null;
		$dnsid  = isset($_args['dnsid']) 	? $_args['dnsid'] 	: null;
		$pay    = isset($_args['pay']) 		? $_args['pay'] 	: null;

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
		$price = 0;

		if($period === '1year')
		{
			$period_month = 12;
			$price = 3000;
		}
		elseif($period === '5year')
		{
			$period_month = 5*12;
			$price = 15000;
		}

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
		else
		{
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
				\dash\notif::error(T_("Please enter the dns records"), ['element' => ['ns1', 'ns2']]);
				return false;
			}
		}


		if(!$pay)
		{
			\dash\notif::error(T_("Please choose your pay type register domain"));
			return false;
		}

		if(!in_array($pay, ['budget', 'gateway', 'auto']))
		{
			\dash\notif::error(T_("Please choose a valid pay type!"));
			return false;
		}


		$check_nic_id = \lib\db\nic_contact\get::user_nic_id(\dash\user::id(), $nic_id);
		if(!isset($check_nic_id['id']))
		{
			$add_quick_contact = \lib\app\nic_contact\add::quick($nic_id);
			if(!$add_quick_contact)
			{
				return false;
			}
		}


		$check_duplicate_domain = \lib\db\nic_domain\get::domain_user($domain, \dash\user::id());
		if(isset($check_duplicate_domain['id']))
		{
			if(isset($check_duplicate_domain['status']))
			{
				switch ($check_duplicate_domain['status'])
				{
					case 'enable':
					case 'disable':
					case 'deleted':
					case 'expire':
						\dash\notif::error(T_("This domain is already in your list"));
						return false;
						break;

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
				'autorenew'    => null,
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
				'turn_back'     => \dash\url::kingdom(). '/my/domain/result?id='. $domain_code,
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
		];

		// need to show result page
		\dash\temp::set('need_show_domain_result', true);

		$result = \lib\nic\exec\domain_create::create($ready);

		if(isset($result['name']))
		{
			$update =
			[
				'dateregister' => $result['dateregister'],
				'dateexpire'   => $result['dateexpire'],
				'datecreated'  => date("Y-m-d H:i:s"),
			];

			\lib\db\nic_domain\update::update($update, $domain_id);

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


			$insert_billing =
			[
				'domain_id'      => $domain_id,
				'user_id'        => \dash\user::id(),
				'action'         => 'buy',
				'mode'           => 'manual',
				'price'          => $price,
				'discount'       => 0,
				'discountcode'   => null,
				'finalprice'     => $price,
				'transaction_id' => $transaction_id,
				'date'           => date("Y-m-d H:i:s"),

			];

			$domain_billing_id = \lib\db\nic_domain_billing\insert::new_record($insert_billing);

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

			\dash\notif::warn(T_("Can not register your domain, Money back to your account"));
		}

	}

}
?>