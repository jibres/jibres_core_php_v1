<?php
namespace lib\app\onlinenic;


class transfer
{
	public static function transfer($_args)
	{
		$condition =
		[
			'domain'    => 'ir_domain',
			'nic_id'    => 'bit',
			'irnic_new' => 'bit',
			'pin'       => 'string',
			'agree'     => 'bit',

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

		$require = ['domain', 'pin'];

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

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$domain    = $data['domain'];
		$pin       = $data['pin'];

		$transaction_id = null;

		\lib\app\domains\detect::domain('start_transfer', $domain);

		$domain_action_detail =
		[
			'domainname'   => $domain,
		];

		\lib\app\nic_domainaction\action::set('domain_transfer_ready', $domain_action_detail);

		$get_contac_nic = [];

		$check_duplicate_domain = \lib\db\nic_domain\get::domain_user($domain, \dash\user::id());


		if(!isset($check_duplicate_domain['holder']))
		{

			$jibreswhoisgard =
			[
				'jibreswhoisgardTe1',
				'jibreswhoisgardTe2',
				'jibreswhoisgardTe3',
				'jibreswhoisgardTe4',
				'jibreswhoisgardTe5',
			];

			if($data['whoistype'] === 'jibreswhoisgard')
			{
				$contact_id = 'jibreswhoisgardTe5'; // get random
			}
			else
			{
				$split = explode('.', $domain);
				$tld   = end($split);

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

		// // check domain exist and unlock doamin
		// $get_domain_detail = \lib\onlinenic\api::info_domain($domain);


		// if(!isset($get_domain_detail['data']['expdate']))
		// {
		// 	\dash\notif::error(T_("Domain is not exists"));
		// 	return false;
		// }


		$price = \lib\app\nic_domain\price::transfer();
		$user_budget = \dash\user::budget();

		if($user_budget >= $price)
		{
			$insert_transaction =
			[
				'user_id' => \dash\user::id(),
				'title'   => T_("Transfer domian :val", ['val' => $domain]),
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
				'msg_go'        => T_("Transfer :domain", ['domain' => $domain]),
				'auto_go'       => false,
				'auto_back'     => false,
				'turn_back'     => \dash\url::kingdom(). '/my/domain',
				'user_id'       => \dash\user::id(),
				'amount'        => abs($price),
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

				\lib\app\nic_domainaction\action::set('domain_tranfer_pay_link', $domain_action_detail);

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
			'contactid' => $contact_id,
			'domain'    => $domain,
			'password'  => $pin,

		];

		$result = \lib\onlinenic\api::domain_transfer($ready);

		if(isset($result['code']) && $result['code'] == 1000)
		{


			\lib\app\domains\detect::domain('transfer', $domain);

			if(isset($check_duplicate_domain['id']))
			{

				$domain_id = $check_duplicate_domain['id'];

				$update =
				[
					'holder'       => $nic_id,
					'admin'        => $nic_id,
					'tech'         => $nic_id,
					'bill'         => $nic_id,
					'verify'       => 1,
					'available'       => 0,
					// 'dns'          => $dnsid,
					'status'       => 'enable',
					'dateregister' => $result['dateregister'],
					'dateexpire'   => $result['dateexpire'],
				];

				\lib\db\nic_domain\update::update($update, $domain_id);



			}
			else
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
					'lock'         => 1,
					'verify'       => 1,
					'available'       => 0,
					// 'dns'          => $dnsid,
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
			}

			$domain_action_detail =
			[
				'domain_id'      => $domain_id,
				'price'          => $price,
				'transaction_id' => $transaction_id,
			];

			\lib\app\nic_domainaction\action::set('transfer', $domain_action_detail);

			$insert_billing =
			[
				'domain_id'      => $domain_id,
				'user_id'        => \dash\user::id(),
				'action'         => 'transfer',
				'status'         => 'enable',
				'mode'           => 'manual',
				'price'          => $price,
				'transaction_id' => $transaction_id,
				'detail'         => null,
				'date'           => date("Y-m-d H:i:s"),
				'datecreated'    => date("Y-m-d H:i:s"),
			];

			$domain_action_id = \lib\db\nic_domainbilling\insert::new_record($insert_billing);

			\dash\notif::ok(T_("Your domain was transfered"), ['alerty' => true]);

			// fetch nic credit after transfer domain
			\lib\app\nic_credit\get::fetch();

			\dash\log::set('domain_newRegister', ['my_domain' => $domain, 'my_type' => 'transfer',  'my_finalprice' => $price]);

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


			$domain_action_detail =
			[
				'domain_id'      => $domain_id,
				'transaction_id' => $transaction_id,
			];

			\lib\app\nic_domainaction\action::set('transfer_failed', $domain_action_detail);



			\dash\temp::set('domainHaveTransaction', true);

			\dash\notif::error(T_("Can not transfer this domain"));
			return false;

		}

	}


}
?>