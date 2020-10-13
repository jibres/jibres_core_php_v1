<?php
namespace lib\app\nic_domain;


class transfer
{
	public static function transfer($_args)
	{
		$condition =
		[
			'domain'       => 'ir_domain',
			'nic_id'       => 'irnic_id',
			'irnic_new'    => 'irnic_id',
			'pin'          => 'string',
			'agree'        => 'bit',

			'fullname'     => 'bit',
			'org'          => 'bit',
			'nationalcode' => 'bit',
			'country'      => 'bit',
			'province'     => 'bit',
			'city'         => 'bit',
			'address'      => 'bit',
			'postcode'     => 'bit',

			'phonecc'      => 'bit',
			'phone'        => 'bit',
			'faxcc'        => 'bit',
			'fax'          => 'bit',

			'email'        => 'bit',
			'whoistype'    => 'bit',





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

		$require = ['domain', 'pin'];

		$meta =
		[
			'field_title' =>
			[

			],
		];


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

		$domain    = $data['domain'];
		$nic_id    = $data['nic_id'];
		$irnic_new = $data['irnic_new'];
		$pin       = $data['pin'];

		$transaction_id = null;

		\lib\app\domains\detect::domain('start_transfer', $domain);

		$domain_action_detail =
		[
			'domainname'   => $domain,
		];

		\lib\app\nic_domainaction\action::set('domain_transfer_ready', $domain_action_detail);

		$get_contac_nic = [];

		if($irnic_new)
		{
			$add_quick_contact = \lib\app\nic_contact\add::quick($irnic_new, $user_id);
			if(!$add_quick_contact)
			{
				\dash\notif::error(T_("Can not add your IRNIC handle"));
				return false;
			}

			$nic_id = $add_quick_contact;
			$get_contac_nic =  \lib\nic\exec\contact_check::check($nic_id);
		}
		else
		{
			$check_nic_id = \lib\db\nic_contact\get::user_nic_id($user_id, $nic_id);
			if(!isset($check_nic_id['nic_id']))
			{
				\dash\notif::error(T_("IRNIC handle not fount in your list"));
				return false;
			}

			$nic_id = $check_nic_id['nic_id'];
			$get_contac_nic[$nic_id] = $check_nic_id;
		}


		$get_domain_detail = \lib\app\nic_domain\check::info($domain);

		if(!isset($get_domain_detail['exDate']))
		{
			// \dash\notif::error(T_("Domain is not exists"));
			return false;
		}


		$price = \lib\app\nic_domain\price::transfer();

		$check_duplicate_domain = \lib\db\nic_domain\get::domain_user($domain, $user_id);

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
				'verify'       => 0,
				'available'       => 0,
				// 'dns'          => $dnsid,
				'status'       => 'awaiting',
				// 'dateregister' => $result['dateregister'],
				// 'dateexpire'   => $result['dateexpire'],
			];

			\lib\db\nic_domain\update::update($update, $domain_id);



		}
		else
		{
			$insert =
			[
				'user_id'      => $user_id,
				'name'         => $domain,
				'registrar'    => 'irnic',
				'status'       => 'awaiting',
				'holder'       => $nic_id,
				'admin'        => $nic_id,
				'tech'         => $nic_id,
				'bill'         => $nic_id,
				'autorenew'    => null,
				'lock'         => 1,
				'verify'       => 0,
				'available'       => 0,
				// 'dns'          => $dnsid,
				// 'dateregister' => $result['dateregister'],
				// 'dateexpire'   => $result['dateexpire'],
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

		$domain_code = \dash\coding::encode($domain_id);

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

					$data['minus_transaction'] = $remain_amount;

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
				$temp_args['agree']             = true;
				$temp_args['register_now']      = true;
				// $temp_args['discount']       = $discount;
				$temp_args['minus_transaction'] = $pay_amount_budget + $pay_amount_bank;
				$temp_args['user_id']           = $user_id;

				// go to bank
				$meta =
				[
					'msg_go'        => T_("Transfer :domain", ['domain' => $domain]),
					'auto_go'       => false,
					'auto_back'     => true,
					'final_msg'     => true,
					'turn_back'     => \dash\url::kingdom(). '/my/domain?resultid='. $domain_code,
					'user_id'       => $user_id,
					'amount'        => abs($remain_amount),
					'final_fn'      => ['/lib/app/nic_domain/transfer', 'transfer'],
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
		// -------------------------------------------------- Transfer now ---------------------------------------------- //




		$ready =
		[
			'nic_id' => $nic_id,
			'domain' => $domain,
			'pin'    => $pin,

		];

		$result = \lib\nic\exec\domain_transfer::transfer($ready);

		if($result)
		{
			// remove verify from all user to accept transfer and then enable domain fo everyone have email of this domain
			\lib\db\nic_domain\update::remove_verify_from_all($domain);

			$update =
			[
				// 'verify'    => 1, // need to wait for transfer complete
				'available' => 0,
				'status'    => 'enable',
			];

			\lib\db\nic_domain\update::update($update, $domain_id);


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
				'user_id'        => $user_id,
				'action'         => 'transfer',
				'status'         => 'enable',
				'mode'           => 'manual',
				'price'          => $price,
				'transaction_id' => $transaction_id,
				'detail'         => null,
				'date'           => date("Y-m-d H:i:s"),
				'datecreated'    => date("Y-m-d H:i:s"),
			];

			if($data['minus_transaction'])
			{
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
			}

			$domain_action_id = \lib\db\nic_domainbilling\insert::new_record($insert_billing);

			\dash\notif::ok(T_("Your domain was transfered"), ['alerty' => true]);

			// fetch nic credit after transfer domain
			\lib\app\nic_credit\get::fetch();

			\dash\log::set('domain_newRegister', ['my_domain' => $domain, 'my_type' => 'transfer',  'my_finalprice' => $price]);

			return true;

		}
		else
		{
			// // have error
			// // need to back money
			// $insert_transaction =
			// [
			// 	'user_id' => $user_id,
			// 	'title'   => T_("Transfer failed :val", ['val' => $domain]),
			// 	'verify'  => 1,
			// 	'plus'    => $price,
			// 	'type'    => 'money',
			// ];

			// $transaction_id = \dash\db\transactions::set($insert_transaction);
			// if(!$transaction_id)
			// {
			// 	\dash\notif::error(T_("No way to insert data"));
			// 	return false;
			// }


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