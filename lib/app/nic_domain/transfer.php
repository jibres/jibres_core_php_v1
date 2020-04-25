<?php
namespace lib\app\nic_domain;


class transfer
{
	public static function transfer($_args)
	{
		$condition =
		[
			'domain'    => 'ir_domain',
			'nic_id'    => 'irnic_id',
			'irnic_new' => 'irnic_id',
			'pin'       => 'string',
			'agree'     => 'bit',
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
			$add_quick_contact = \lib\app\nic_contact\add::quick($irnic_new);
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
			$check_nic_id = \lib\db\nic_contact\get::user_nic_id(\dash\user::id(), $nic_id);
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
			'nic_id' => $nic_id,
			'domain' => $domain,
			'pin'    => $pin,

		];

		$result = \lib\nic\exec\domain_transfer::transfer($ready);

		if($result)
		{
			$check_duplicate_domain = \lib\db\nic_domain\get::domain_user($domain, \dash\user::id());

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