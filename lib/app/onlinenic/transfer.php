<?php
namespace lib\app\onlinenic;


class transfer
{
	public static function transfer($_args)
	{
		$condition =
		[
			'domain'            => 'domain',
			'whoistype'         => ['enum' => ['jibreswhoisgard', 'customizedetail']],
			'pin'               => 'string',
			'nic_id'            => 'bit',
			'irnic_new'         => 'bit',
			'agree'             => 'bit',
			'nationalcode'      => 'bit',
			// .com request // only set this parametr on validate to have not error in cleans
			'fullname'          => 'enstring_60',
			'org'               => 'enstring_60',
			'country'           => ['enum' => ['AU','AF','AL','DZ','AS','AD','AO','AI','AQ','AG','AR','AM','AW','AT','AZ','BS','BH','BD','BB','BY','BE','BZ','BJ','BM','BO','BA','BW','BV','BR','IO','BN','BG','BF','BI','BT','KH','CM','CA','CV','KY','CF','TD','CL','CN','CX','CC','CO','KM','CG','CK','CR','HR','CY','CZ','DK','DJ','DM','DO','TP','EC','EG','SV','GQ','EE','ET','FK','FO','FJ','FI','SU','FX','FR','TF','GA','GM','GE','DE','GH','GI','GB','GR','GL','GD','GP','GU','GT','GW','GN','GF','GY','HT','HM','HN','HK','HU','IS','IN','ID','IQ','IE','IL','IT','CI','JM','JP','JO','JF','KZ','KE','KG','KI','KR','KW','LA','LV','LB','LS','LR','LY','LI','LT','LU','MO','MK','MG','MW','MY','MV','ML','MT','MH','MQ','MR','MU','YT','MX','FM','MD','MC','MN','ME','MS','MA','MZ','MM','NA','NR','NP','AN','NL','NC','NZ','NI','NE','NG','NU','NF','MP','NO','EM','OM','PK','PW','PA','PG','PY','PE','PH','PN','PL','PF','PT','ZN','PR','QA','RE','RO','RU','RW','GS','LC','WS','SM','SA','SN','SC','SL','SG','SK','SI','SB','SO','ZA','ES','LK','SH','PM','ST','KN','VC','RS','SR','SJ','SZ','SE','CH','TJ','TW','TZ','TH','TG','TK','TO','TT','TN','TR','TM','TC','TV','UM','UG','UA','AE','US','UY','UZ','VU','VA','VE','VN','VG','VI','WF','EH','YE','YU','ZM','ZW','ZR',]],
			'province'          => 'enstring_60',
			'city'              => 'enstring_60',
			'address'           => 'enstring_60',
			'postcode'          => 'postcode',
			'phone'             => 'number',
			'fax'               => 'number',
			'email'             => 'email',
			'phonecc'           => 'intstring_3',
			'faxcc'             => 'intstring_3',

			'register_now'      => 'bit',
			'gift'              => 'string_100',
			'usebudget'         => 'bit',
			'discount'          => 'price',
			'pay_amount_bank'   => 'price',
			'pay_amount_budget' => 'price',
			'minus_transaction' => 'price',
			'after_pay'         => 'bit',
			'user_id'           => 'id',


		];

		$require = ['domain'];

		if(isset($_args['whoistype']) && $_args['whoistype'] === 'customizedetail')
		{
			array_push($require, 'fullname');
			array_push($require, 'org');
			array_push($require, 'country');
			array_push($require, 'province');
			array_push($require, 'city');
			array_push($require, 'address');
			array_push($require, 'postcode');
			array_push($require, 'phone');
			array_push($require, 'email');
			array_push($require, 'fax');
			array_push($require, 'phonecc');
			array_push($require, 'faxcc');
		}


		$meta    = [];

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


		$domain      = $data['domain'];



		\lib\app\domains\detect::domain('transfer', $domain);

		$transaction_id = null;

		$price        = \lib\app\onlinenic\price::get_price($domain, null, 'transfer');

		if(!$price)
		{
			// error in load price
			\dash\notif::error(T_("Can not load domain price"));
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
				'available'    => 0,

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
				'available'    => 0,

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


		if(!isset($check_duplicate_domain['holder']))
		{
			if($data['whoistype'] === 'jibreswhoisgard')
			{
				$contact_id = \lib\app\onlinenic\gard::get(); // get random
			}
			else
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

				\lib\app\nic_usersetting\set::set($create_new_contact);

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


				$contact_id = \lib\onlinenic\api::create_contact_id($create_new_contact);

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
			}

			\lib\db\nic_domain\update::update(['holder' => $contact_id], $domain_id);
		}
		else
		{
			$contact_id = $check_duplicate_domain['holder'];
		}



		$domain_code = \dash\coding::encode($domain_id);
		\dash\temp::set('domain_code_url', $domain_code);

		// -------------------------------------------------- Check to redirec to review or register now ---------------------------------------------- //
		if(!$data['register_now'])
		{
			$domain_action_detail =
			[
				'domain_id' => $domain_id,
				'detail'    => json_encode($data, JSON_UNESCAPED_UNICODE),
			];

			\lib\app\nic_domainaction\action::set('domain_transfer_ready', $domain_action_detail);

			$result              = [];
			$result['domain_id'] = $domain_code;

			\dash\notif::ok(T_("Domain ready to transfer"));
			return $result;
		}

		// check gift card
		$remain_amount     = $price;
		$discount          = 0;

		if($data['gift'])
		{
			$gift_args =
			[
				'code'    => $data['gift'],
				'price'   => $price,
				'user_id' => $user_id,
				'usein'   => 'domain',
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
			$minus_transaction = 0;
			$pay_amount_bank   = 0;
			$pay_amount_budget = 0;

			if($remain_amount <= 0)
			{
				// all price minus by gift card
			}
			else
			{
				$user_budget = floatval(\dash\db\transactions::budget($user_id));

				if($data['usebudget'] && $user_budget)
				{
					$pay_amount_budget = $remain_amount;

					$minus_transaction = $remain_amount;

					$remain_amount = floatval($remain_amount) - floatval($user_budget);

				}
				else
				{
					$pay_amount_bank                = $remain_amount;
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
					'msg_go'        => T_("Transfer :domain", ['domain' => $domain]),
					'auto_go'       => false,
					'auto_back'     => false,
					'final_msg'     => true,
					'turn_back'     => \dash\url::kingdom(). '/my/domain?resultid='. $domain_code,
					'user_id'       => $user_id,
					'amount'        => abs($remain_amount),
					'final_fn'      => ['/lib/app/onlinenic/transfer', 'transfer'],
					'final_fn_args' => $temp_args,
				];


				$result_pay = \dash\utility\pay\start::api($meta);

				if(isset($result_pay['url']) && isset($result_pay['transaction_id']))
				{
					$domain_action_detail =
					[
						'transaction_id' => \dash\coding::decode($result_pay['transaction_id']),
						'domain_id'      => $domain_id,
						'detail'         => json_encode(['pay_link' => $result_pay['url']], JSON_UNESCAPED_UNICODE),
					];

					\lib\app\nic_domainaction\action::set('domain_transfer_pay_link', $domain_action_detail);

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
		}
		// -------------------------------------------------- Register now ---------------------------------------------- //


		$ready =
		[
			'domain'    => $domain,
			'password'  => $data['pin'],
			'contactid' => $contact_id,
		];


		$finalprice = floatval($price) - floatval($discount);
		$gift_usage_id = null;


		$insert_transaction =
		[
			'user_id' => $user_id,
			'title'   => T_("Transfer domian :val", ['val' => $domain]),
			'verify'  => 1,
			'minus'   => floatval($data['minus_transaction']),
			'type'    => 'money',
		];

		$transaction_id = \dash\db\transactions::set($insert_transaction);

		if(!$transaction_id)
		{
			\dash\log::oops('transaction_db');
			return false;
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
			'discount'       => $discount,
			'finalprice'     => $finalprice,
			'transaction_id' => $transaction_id,
			'giftusage_id'   => $gift_usage_id,
		];

		\lib\app\nic_domainaction\action::set('transfer', $domain_action_detail);

		$insert_billing =
		[
			'domain_id'      => $domain_id,
			'user_id'        => $user_id,
			'action'         => 'transfer',
			'status'         => 'enable',
			'mode'           => 'manual',
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
		$result = \lib\onlinenic\api::transfer_domain($ready);


		// $result                 = [];
		// $result['name']         = $domain;
		// $result['dateregister'] = null;
		// $result['dateexpire']   = null;

		if(isset($result['code']) && $result['code'] == 1000 )
		{
			$update =
			[
				'status'       => 'enable',
				'verify'       => 1,

				'autorenew'    => 1,
				'lock'         => 1,
				'available'    => 0,
			];

			\lib\db\nic_domain\update::update($update, $domain_id);



			\dash\notif::ok(T_("Domain :domain was transfered in your name", ['domain' => $domain]), ['alerty' => true]);

			\dash\log::set('domain_newTransfer', ['my_domain' => $domain, 'my_type' => 'transfer', 'my_giftusage_id' => $gift_usage_id, 'my_finalprice' => $finalprice]);


			return true;

		}
		else
		{
			// have error in transfer domain
			$update =
			[
				'status'       => 'failed',
			];

			\lib\db\nic_domain\update::update($update, $domain_id);

			$domain_action_detail =
			[
				'domain_id'      => $domain_id,
				// 'price'          => $price,
				// 'finalprice'     => $finalprice,
				// 'discount'       => $discount,
				// 'period'         => $period,
				'transaction_id' => $transaction_id,
			];

			\lib\app\nic_domainaction\action::set('transfer_failed', $domain_action_detail);

			\dash\notif::warn(T_("Can not transfer your domain"));
		}
	}
}
?>