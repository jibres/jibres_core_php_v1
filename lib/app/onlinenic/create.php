<?php
namespace lib\app\onlinenic;


class create
{
	public static function new_domain($_args)
	{
		$condition =
		[
			'domain'               => 'domain',
			'nic_id'               => 'bit',
			'period'               => ['enum' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]],
			'whoistype'            => ['enum' => ['jibreswhoisgard', 'customizedetail']],
			'ns1'                  => 'dns',
			'ns2'                  => 'dns',
			'ns3'                  => 'dns',
			'ns4'                  => 'dns',

			'dnsid'                => 'string',
			'irnic_admin'          => 'bit',
			'irnic_tech'           => 'bit',
			'irnic_bill'           => 'bit',
			'irnic_new'            => 'bit',
			'agree'                => 'bit',
			'register_now'         => 'bit',
			'gift'                 => 'string_100',
			'usebudget'            => 'bit',
			'discount'             => 'price',
			'pay_amount_bank'      => 'price',
			'pay_amount_budget'    => 'price',
			'minus_transaction'    => 'price',
			'after_pay'            => 'bit',
			'user_id'              => 'id',
			'admin_register_force' => 'bit',
			'nationalcode'         => 'bit',

			// .com request // only set this parametr on validate to have not error in cleans
			'fullname'             => 'enstring_60',
			'org'                  => 'enstring_60',
			'country'              => ['enum' => ['AU','AF','AL','DZ','AS','AD','AO','AI','AQ','AG','AR','AM','AW','AT','AZ','BS','BH','BD','BB','BY','BE','BZ','BJ','BM','BO','BA','BW','BV','BR','IO','BN','BG','BF','BI','BT','KH','CM','CA','CV','KY','CF','TD','CL','CN','CX','CC','CO','KM','CG','CK','CR','HR','CY','CZ','DK','DJ','DM','DO','TP','EC','EG','SV','GQ','EE','ET','FK','FO','FJ','FI','SU','FX','FR','TF','GA','GM','GE','DE','GH','GI','GB','GR','GL','GD','GP','GU','GT','GW','GN','GF','GY','HT','HM','HN','HK','HU','IS','IN','ID','IQ','IE','IL','IT','CI','JM','JP','JO','JF','KZ','KE','KG','KI','KR','KW','LA','LV','LB','LS','LR','LY','LI','LT','LU','MO','MK','MG','MW','MY','MV','ML','MT','MH','MQ','MR','MU','YT','MX','FM','MD','MC','MN','ME','MS','MA','MZ','MM','NA','NR','NP','AN','NL','NC','NZ','NI','NE','NG','NU','NF','MP','NO','EM','OM','PK','PW','PA','PG','PY','PE','PH','PN','PL','PF','PT','ZN','PR','QA','RE','RO','RU','RW','GS','LC','WS','SM','SA','SN','SC','SL','SG','SK','SI','SB','SO','ZA','ES','LK','SH','PM','ST','KN','VC','RS','SR','SJ','SZ','SE','CH','TJ','TW','TZ','TH','TG','TK','TO','TT','TN','TR','TM','TC','TV','UM','UG','UA','AE','US','UY','UZ','VU','VA','VE','VN','VG','VI','WF','EH','YE','YU','ZM','ZW','ZR',]],
			'province'             => 'enstring_60',
			'city'                 => 'enstring_60',
			'address'              => 'enstring_60',
			'postcode'             => 'postcode',
			'phone'                => 'number',
			'fax'                  => 'number',
			'email'                => 'email',
			'phonecc'              => 'intstring_3',
			'faxcc'                => 'intstring_3',
		];

		$require =
		[
			'domain',
			'fullname',
			'org',
			'country',
			'province',
			'city',
			'address',
			'postcode',
			'phone',
			'email',
			'fax',
			'phonecc',
			'faxcc',
		];


		$meta    =
		[
			'field_title' =>
			[
				'faxcc'   => T_("Code"),
				'phonecc' => T_("Code"),
			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		// after pay get user id from args
		$user_id = $data['user_id'];

		if(!$user_id)
		{
			$user_id = \dash\user::id();
		}

		if(!$user_id)
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		if(!$data['period'])
		{
			\dash\notif::error(T_("Please indicate the duration of the domain purchase?"));
			return false;
		}

		$domain      = $data['domain'];

		$period      = $data['period'];

		$ns1         = $data['ns1'];
		$ns2         = $data['ns2'];
		$ns3         = $data['ns3'];
		$ns4         = $data['ns4'];

		// set detect
		\lib\app\domains\detect::domain('register', $domain);
		\lib\app\domains\detect::dns($ns1);
		\lib\app\domains\detect::dns($ns2);
		\lib\app\domains\detect::dns($ns3);
		\lib\app\domains\detect::dns($ns4);

		if(!$ns1)
		{
			$ns1 = \lib\app\nic_usersetting\defaultval::ns1($domain);
		}

		if(!$ns2)
		{
			$ns2 = \lib\app\nic_usersetting\defaultval::ns2($domain);
		}


		$transaction_id = null;

		$price        = \lib\app\onlinenic\price::get_price($domain, $period, 'register');

		if(!$price)
		{
			// error in load price
			// the notif maked in get_price function
			return false;
		}


		$check_duplicate_domain = \lib\db\nic_domain\get::domain_user($domain, $user_id);

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
				'registrar'    => 'onlinenic',
				'status'       => 'awaiting',

				'autorenew'    => null,
				'lock'         => null,
				'available'    => 1,

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
				'user_id'      => $user_id,
				'name'         => $domain,
				'registrar'    => 'onlinenic',
				'status'       => 'awaiting',

				'autorenew'    => null,
				'lock'         => null,
				'available'    => 1,

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


		if(!a($check_duplicate_domain, 'holder') || a($check_duplicate_domain, 'holder') === 'jibres-whois-guard-1')
		{
			$split = explode('.', $domain);
			$tld   = end($split);

			$create_new_contact =
			[
				'fullname' => $data['fullname'],
				'company'  => $data['org'],
				'country'  => $data['country'],
				'province' => $data['province'],
				'city'     => $data['city'],
				'address'  => $data['address'],
				'postcode' => $data['postcode'],
				'phone'    => $data['phone'],
				'phonecc'  => $data['phonecc'],
				'fax'      => $data['fax'],
				'faxcc'    => $data['faxcc'],
				'email'    => $data['email'],
			];

			\lib\app\nic_usersetting\set::set($create_new_contact, false);

			$create_new_contact =
			[
				'ext'        => $tld,
				'name'       => $data['fullname'],
				'org'        => $data['org'],
				'country'    => $data['country'],
				'province'   => $data['province'],
				'city'       => $data['city'],
				'street'     => $data['address'],
				'postalcode' => $data['postcode'],
				'voice'      => '+'. $data['phonecc'] . '.'. $data['phone'],
				'fax'        => '+'. $data['faxcc'] . '.'. $data['fax'],
				'email'      => $data['email'],
			];


			$contact_id = \lib\api\onlinenic\api::create_contact_id($create_new_contact);

			if(isset($contact_id['data']['contactid']))
			{
				$contact_id = $contact_id['data']['contactid'];
			}
			else
			{
				\dash\notif::error(T_("Some detail is wrong!. We can not create your whois detail"));
				return false;
			}

			if(!$contact_id)
			{
				\dash\notif::error(T_("Can not save your whois detail at this time. Please try later"));
				return false;
			}


			\lib\db\nic_domain\update::update(['holder' => $contact_id], $domain_id);
		}
		else
		{
			$contact_id = $check_duplicate_domain['holder'];
		}



		$domain_code = \dash\coding::encode($domain_id);
		\dash\temp::set('domain_code_url', $domain_code);
		\dash\temp::set('domain_name_url', $domain);


		// -------------------------------------------------- Check to redirec to review or register now ---------------------------------------------- //
		if(!$data['register_now'])
		{
			$domain_action_detail =
			[
				'domain_id' => $domain_id,
				'period'    => $period,
				'detail'    => json_encode($data, JSON_UNESCAPED_UNICODE),
			];

			\lib\app\nic_domainaction\action::set('domain_buy_ready', $domain_action_detail);

			$result              = [];
			$result['domain_id'] = $domain_code;

			\dash\notif::ok(T_("Domain ready to register"));
			return $result;
		}

		// check gift card
		$remain_amount     = $price;
		$discount          = 0;

		if($data['gift'])
		{
			$gift_args =
			[
				'domain'        => $domain,
				'domain_period' => $period,
				'code'          => $data['gift'],
				'price'         => $price,
				'user_id'       => $user_id,
				'usein'         => 'domain',
			];

			$gift_detail = \lib\app\gift\check::check($gift_args);

			if(!\dash\engine\process::status())
			{
				return false;
			}

			$discount      = $gift_detail['discount'];
			$remain_amount = $remain_amount - floatval($discount);
		}



		// this code just run before pay
		if(!$data['after_pay'])
		{

			$pay_amount_bank   = 0;
			$pay_amount_budget = 0;

			if($remain_amount <= 0)
			{
				// all price minus by gift card
			}
			else
			{
				$user_budget = floatval(\dash\app\transaction\budget::user($user_id));

				if($data['usebudget'] && $user_budget)
				{
					$pay_amount_budget = $remain_amount;

					$data['minus_transaction'] = $remain_amount;

					$remain_amount = floatval($remain_amount) - floatval($user_budget);

				}
				else
				{
					$pay_amount_bank                = $remain_amount;
				}

				if(\dash\url::is_api() && $data['usebudget'] && $remain_amount > 0)
				{
					\dash\notif::error(T_("Your account credit is not sufficient. Please charge your account"), ['code' => 3000]);
					return false;
				}
			}

			if($remain_amount > 0)
			{

				$temp_args                      = $data;
				$temp_args['pay_amount_bank']   = $pay_amount_bank;
				$temp_args['pay_amount_budget'] = $pay_amount_budget;
				$temp_args['after_pay']         = true;
				// $temp_args['discount']          = $discount;
				$temp_args['minus_transaction'] = $pay_amount_budget + $pay_amount_bank;
				$temp_args['user_id']           = $user_id;


				// go to bank
				$meta =
				[
					'msg_go'        => T_("Buy :domain For :year", ['domain' => $domain, 'year' => \dash\fit::number($period)]),
					'auto_go'       => false,
					'auto_back'     => true,
					'final_msg'     => true,
					'turn_back'     => \dash\url::kingdom(). '/my/domain?resultid='. $domain_code,
					'user_id'       => $user_id,
					'amount'        => abs($remain_amount),
					'final_fn'      => ['/lib/app/onlinenic/create', 'new_domain'],
					'final_fn_args' => $temp_args,
				];


				$result_pay = \dash\utility\pay\start::api($meta);

				if(isset($result_pay['url']) && isset($result_pay['transaction_id']))
				{
					$domain_action_detail =
					[
						'transaction_id' => \dash\coding::decode($result_pay['transaction_id']),
						'domain_id'      => $domain_id,
						'period'         => $period,
						'detail'         => json_encode(['pay_link' => $result_pay['url']], JSON_UNESCAPED_UNICODE),
					];

					\lib\app\nic_domainaction\action::set('domain_buy_pay_link', $domain_action_detail);

					if(\dash\url::is_api())
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
		}

		// -------------------------------------------------- Register now ---------------------------------------------- //


		$ready =
		[
			'domain'     => $domain,
			'period'     => $period,
			'dns1'       => $ns1,
			'dns2'       => $ns2,
			// 'lang'       => 'ENG',
			'registrant' => $contact_id,
			'admin'      => $contact_id,
			'tech'       => $contact_id,
			'billing'    => $contact_id

		];


		$finalprice = floatval($price) - floatval($discount);
		$gift_usage_id = null;

		if($data['minus_transaction'])
		{
			\dash\pdo::transaction();
			// check budget
			$user_budget = \dash\app\transaction\budget::get_and_lock($user_id);

			if($user_budget < floatval($data['minus_transaction']))
			{
				\dash\notif::error(T_("Your budget is low!"));
				\dash\pdo::rollback();
				return false;
			}

			$insert_transaction =
			[
				'user_id' => $user_id,
				'title'   => T_("Register domian :val", ['val' => $domain]),
				'amount'  => floatval($data['minus_transaction']),
			];

			\dash\app\transaction\budget::minus($insert_transaction);

			\dash\pdo::commit();

		}



		if($data['gift'])
		{
			$gift_meta =
			[
				'code'            => $data['gift'],
				'transaction_id'  => $transaction_id,
				'price'           => $price,
				'discount'        => $discount,
				'discountpercent' => round((floatval($discount) * 100) / floatval($price)),
				'finalprice'      => $finalprice,
				'user_id'         => $user_id,
			];

			$gift_usage_id = \lib\app\gift\usage::set($gift_meta);
		}


		$domain_action_detail =
		[
			'domain_id'      => $domain_id,
			'price'          => $price,
			'period'         => $period,
			'discount'       => $discount,
			'finalprice'     => $finalprice,
			'transaction_id' => $transaction_id,
			'giftusage_id'   => $gift_usage_id,
		];

		\lib\app\nic_domainaction\action::set('register', $domain_action_detail);

		$insert_billing =
		[
			'domain_id'      => $domain_id,
			'user_id'        => $user_id,
			'action'         => 'register',
			'status'         => 'enable',
			'mode'           => 'manual',
			'period'         => $period,
			'price'          => $price,
			'discount'       => $discount,
			'finalprice'     => $finalprice,
			'transaction_id' => $transaction_id,
			'detail'         => null,
			'date'           => date("Y-m-d H:i:s"),
			'datecreated'    => date("Y-m-d H:i:s"),
			'giftusage_id'   => $gift_usage_id,
		];

		$domain_action_id = \lib\db\nic_domainbilling\insert::new_record($insert_billing);


			// run nic create domain exec
		$result = \lib\api\onlinenic\api::register_domain($ready);


		if(isset($result['data']['domain']) && isset($result['data']['regdate']) && isset($result['data']['expdate']))
		{

			$update =
			[
				'status'       => 'enable',
				'verify'       => 1,

				// 'autorenew'    => 1,
				'lock'         => 1,
				'available'    => 0,

				'dateregister' => $result['data']['regdate'],
				'dateexpire'   => $result['data']['expdate'],
				'datemodified'  => date("Y-m-d H:i:s"),
			];

			\lib\db\nic_domain\update::update($update, $domain_id);
			// commit ok
			\dash\notif::ok(T_("Domain :domain was registered in your name", ['domain' => $domain]), ['alerty' => true]);

			\lib\app\business_domain\add::from_domain_approved($domain);

			\dash\log::set('domain_newRegister', ['my_domain' => $domain, 'my_period' => $period, 'my_type' => 'register', 'my_giftusage_id' => $gift_usage_id, 'my_finalprice' => $finalprice]);

			return true;
		}
		else
		{
			if(isset($result['code']) && is_numeric($result['code']) && floatval($result['code']) !== floatval(1000))
			{
				// onlinenic error. need to back money
				if($data['minus_transaction'])
				{

					$insert_transaction =
					[
						'user_id' => $user_id,
						'title'   => T_("Refund money for register domian :val", ['val' => $domain]),
						'amount'  => floatval($data['minus_transaction']),

					];

					\dash\log::to_supervisor($insert_transaction['title']);

					$transaction_id = \dash\app\transaction\budget::plus($insert_transaction);

					if(!$transaction_id)
					{
						\dash\log::oops('transaction_db');
						return false;
					}
					\dash\log::to_supervisor($insert_transaction['title']);
				}



			}

			\dash\log::to_supervisor('failed to register domain '. $domain);

			// have error in register domain
			$update =
			[
				'status'       => 'failed',
			];

			\lib\db\nic_domain\update::update($update, $domain_id);

			$domain_action_detail =
			[
				'domain_id'      => $domain_id,
				'price'          => $price,
				'period'         => $period,
				'discount'       => $discount,
				'finalprice'     => $finalprice,
				'transaction_id' => $transaction_id,
				'giftusage_id'   => $gift_usage_id,
			];

			\lib\app\nic_domainaction\action::set('register_failed', $domain_action_detail);

			\dash\notif::error(T_("Can not register your domain"));

			\dash\log::set('domain_newRegisterError', ['my_domain' => $domain, 'my_period' => $period, 'my_type' => 'register', 'my_giftusage_id' => $gift_usage_id, 'my_finalprice' => $finalprice, 'my_result' => $result]);
		}
	}
}
?>