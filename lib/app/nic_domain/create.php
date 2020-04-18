<?php
namespace lib\app\nic_domain;


class create
{
	public static function new_domain($_args)
	{
		$condition =
		[
			'domain'       => 'ir_domain',
			'nic_id'       => 'irnic_id',
			'period'       => ['enum' => ['1year', '5year']],
			'ns1'          => 'dns',
			'ns2'          => 'dns',
			'ns3'          => 'dns',
			'ns4'          => 'dns',
			'dnsid'        => 'string',
			'irnic_admin'  => 'irnic_id',
			'irnic_tech'   => 'irnic_id',
			'irnic_bill'   => 'irnic_id',
			'irnic_new'    => 'irnic_id',
			'agree'        => 'bit',
			'register_now' => 'bit',
		];

		$require = ['domain'];

		$meta = [];


		if(isset($_args['agree']) && $_args['agree'])
		{
			// nothing
		}
		else
		{
			\dash\notif::error(T_("Please view the privacy policy and check 'I agree' check box"), 'agree');
			return false;
		}

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['period'])
		{
			\dash\notif::error(T_("Please indicate the duration of the domain purchase, 1 year or 5 year?"));
			return false;
		}

		$domain      = $data['domain'];
		$nic_id      = $data['nic_id'];
		$period      = $data['period'];
		$ns1         = $data['ns1'];
		$ns2         = $data['ns2'];
		$ns3         = $data['ns3'];
		$ns4         = $data['ns4'];
		// $dnsid       = $data['dnsid'];


		\lib\app\domains\detect::domain('register', $domain);
		\lib\app\domains\detect::dns($ns1);
		\lib\app\domains\detect::dns($ns2);
		\lib\app\domains\detect::dns($ns3);
		\lib\app\domains\detect::dns($ns4);



		$irnic_admin = $data['irnic_admin'];
		$irnic_tech  = $data['irnic_tech'];
		$irnic_bill  = $data['irnic_bill'];
		$irnic_new  = $data['irnic_new'];

		$ip1 = null;
		$ip2 = null;
		$ip3 = null;
		$ip4 = null;


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
			\dash\notif::error(T_("Please enter IRNIC handle"), 'irnicid-new');
			return false;
		}


		$get_contac_nic = [];

		if($irnic_new)
		{
			$add_quick_contact = \lib\app\nic_contact\add::quick($irnic_new);
			if(!$add_quick_contact)
			{
				return false;
			}

			$nic_id = $add_quick_contact;
			$get_contac_nic =  \lib\nic\exec\contact_check::check($nic_id);
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
			$get_contac_nic[$nic_id] =  $check_nic_id;
		}


		if($irnic_bill)
		{
			$get_contac_nic_bill =  \lib\nic\exec\contact_check::check($irnic_bill);
			if(!isset($get_contac_nic_bill[$irnic_bill]))
			{
				// bug!!
				\dash\notif::error(T_("Can not find  billing account detail of this domain"));
				return false;
			}

			if(!isset($get_contac_nic_bill[$irnic_bill]))
			{
				// bug!!
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


		// if($dnsid && $dnsid != 'something-else')
		// {
		// 	$load_dns = \lib\app\nic_dns\get::get($dnsid);

		// 	if(!$load_dns)
		// 	{
		// 		\dash\notif::error(T_("DNS not found"));
		// 		return false;
		// 	}

		// 	$dnsid = \dash\coding::decode($dnsid);

		// 	$ns1 = $load_dns['ns1'];
		// 	$ns2 = $load_dns['ns2'];
		// 	$ns3 = $load_dns['ns3'];
		// 	$ns4 = $load_dns['ns4'];

		// 	$ip1 = $load_dns['ip1'];
		// 	$ip2 = $load_dns['ip2'];
		// 	$ip3 = $load_dns['ip3'];
		// 	$ip4 = $load_dns['ip4'];


		// }
		// else
		// {
		// 	if($ns1 && $ns2)
		// 	{
		// 		$get_ns_record = \lib\db\nic_dns\get::by_ns1_ns2(\dash\user::id(), $ns1, $ns2);
		// 		if(!isset($get_ns_record['id']))
		// 		{
		// 			$dnsid = \lib\app\nic_dns\add::quick($ns1, $ns2);
		// 			if(!$dnsid)
		// 			{
		// 				$dnsid = null;
		// 			}
		// 		}
		// 	}

		// }

		// if($dnsid === 'something-else')
		// {
		// 	$dnsid = null;
		// }



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
					case 'awaiting':
					default:
						$domain_id = $check_duplicate_domain['id'];
						break;
				}
			}
			else
			{
				$domain_id = $check_duplicate_domain['id'];
			}

			$update_domain_record =
			[
				'registrar'    => 'irnic',
				'status'       => 'awaiting',

				'holder'       => $nic_id,
				'admin'        => $nic_id,
				'tech'         => $nic_id,
				'bill'         => $nic_id,

				'autorenew'    => 1,
				'lock'         => 1,

				'ns1'          => $ns1,
				'ns2'          => $ns2,
				'ns3'          => $ns3,
				'ns4'          => $ns4,

			];

			\lib\db\nic_domain\update::update($update_domain_record, $domain_id);


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

				'ns1'          => $ns1,
				'ns2'          => $ns2,
				'ns3'          => $ns3,
				'ns4'          => $ns4,
				// 'dns'       => $dnsid,

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

		$domain_action_detail =
		[
			'domain_id' => $domain_id,
			'period'    => $period_month,
		];

		\lib\app\nic_domainaction\action::set('domain_buy_ready', $domain_action_detail);


		$domain_code = \dash\coding::encode($domain_id);
		\dash\temp::set('domain_code_url', $domain_code);

		if(!$data['register_now'])
		{
			$result              = [];
			$result['domain_id'] = $domain_code;

			\dash\notif::ok(T_("Domain ready to register"));
			return $result;
		}

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
			$temp_args = $data;

			// go to bank
			$meta =
			[
				'msg_go'        => T_("Buy :domain For :year year by IRNIC handle :nic_id", ['domain' => $domain, 'year' => \dash\fit::number(round($period_month / 12)), 'nic_id' => $nic_id]),
				'auto_go'       => false,
				'auto_back'     => true,
				'final_msg'     => true,
				'turn_back'     => \dash\url::kingdom(). '/my/domain?resultid='. $domain_code,
				'user_id'       => \dash\user::id(),
				'amount'        => abs($price),
				'final_fn'      => ['/lib/app/nic_domain/create', 'new_domain'],
				'final_fn_args' => $temp_args,
			];


			$result_pay = \dash\utility\pay\start::api($meta);

			if(isset($result_pay['url']) && isset($result_pay['transaction_id']))
			{
				$domain_action_detail =
				[
					'transaction_id' => \dash\coding::decode($result_pay['transaction_id']),
					'domain_id'      => $domain_id,
					'period'    => $period_month,
					'detail'         => json_encode(['pay_link' => $result_pay['url']], JSON_UNESCAPED_UNICODE),
				];

				\lib\app\nic_domainaction\action::set('domain_buy_pay_link', $domain_action_detail);

				if(\dash\engine\content::api_content())
				{
					$msg = T_("Pay link :val", ['val' => $result_pay['url']]);
					\dash\notif::meta($result_pay);
					\dash\notif::ok($msg);
					return;
				}
				else
				{
					\dash\redirect::to($result_pay['url']);
				}
			}
			else
			{
				\dash\log::oops('generate_pay_error');
				return false;
			}




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

			$domain_action_detail =
			[
				'domain_id'      => $domain_id,
				'price'          => $price,
				'period'         => $period_month,
				'transaction_id' => $transaction_id,
			];

			\lib\app\nic_domainaction\action::set('register', $domain_action_detail);

			$insert_billing =
			[
				'domain_id'      => $domain_id,
				'user_id'        => \dash\user::id(),
				'action'         => 'register',
				'status'         => 'enable',
				'mode'           => 'manual',
				'period'         => $period_month,
				'price'          => $price,
				'transaction_id' => $transaction_id,
				'detail'         => null,
				'date'           => date("Y-m-d H:i:s"),
				'datecreated'    => date("Y-m-d H:i:s"),
			];

			$domain_action_id = \lib\db\nic_domainbilling\insert::new_record($insert_billing);

			\dash\notif::ok(T_("Domain :domain was registered in your name", ['domain' => $domain]), ['alerty' => true]);


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

			$domain_action_detail =
			[
				'domain_id'      => $domain_id,
				'price'          => $price,
				'period'         => $period_month,
				'transaction_id' => $transaction_id,
			];

			\lib\app\nic_domainaction\action::set('register_failed', $domain_action_detail);


			\dash\notif::warn(T_("Can not register your domain, Money back to your account"));

			\dash\temp::set('domainHaveTransaction', true);
		}

	}

}
?>