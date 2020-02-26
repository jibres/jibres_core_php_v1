<?php
namespace lib\app\nic_domain;


class transfer
{
	public static function transfer($_args)
	{
		$domain    = isset($_args['domain']) 	? $_args['domain'] 		: null;
		$nic_id    = isset($_args['nic_id']) 	? $_args['nic_id'] 		: null;
		$irnic_new = isset($_args['irnic_new']) ? $_args['irnic_new'] 	: null;
		$pin       = isset($_args['pin']) 		? $_args['pin'] 		: null;

		$transaction_id = null;

		if(!$domain)
		{
			\dash\notif::error(T_("Please set domain"));
			return false;
		}


		if(!\lib\app\nic_domain\check::syntax_ir($domain))
		{
			\dash\notif::error(T_("Only ir domain can be transfer to us at this time"));
			return false;
		}


		if(!$pin || !is_string($pin))
		{
			\dash\notif::error(T_("Please set pin"));
			return false;
		}

		if($irnic_new)
		{
			$add_quick_contact = \lib\app\nic_contact\add::quick($irnic_new);
			if(!$add_quick_contact)
			{
				\dash\notif::error(T_("Can not add your IRNIC handle"));
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


		$get_domain_detail = \lib\app\nic_domain\check::info($domain);

		if(!isset($get_domain_detail['exDate']))
		{
			// \dash\notif::error(T_("Domain is not exists"));
			return false;
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

		if(isset($get_contac_nic[$nic_id]['bill']) && $get_contac_nic[$nic_id]['bill'] == '1')
		{
			// no problem to transfer this domain by tihs contact
		}
		else
		{
			\dash\notif::error(T_("We can not transfer this domain because the bill holder of IRNIC can not access to transfer"));
			return false;
		}


		if(isset($get_contac_nic[$nic_id]['admin']) && $get_contac_nic[$nic_id]['admin'] == '1')
		{
			// no problem to transfer this domain by tihs contact
		}
		else
		{
			\dash\notif::error(T_("We can not transfer this domain because the admin holder of IRNIC can not access to transfer"));
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
				'msg_go'        => null,
				'auto_go'       => false,
				'auto_back'       => true,
				'turn_back'     => \dash\url::kingdom(). '/my/domain',
				'user_id'       => \dash\user::id(),
				'amount'        => abs($price),
				'final_fn'      => ['/lib/app/nic_domain/transfer', 'transfer'],
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
			'pin'    => $pin,

		];

		$result = \lib\nic\exec\domain_transfer::transfer($ready);

		if($result)
		{
			$check_duplicate_domain = \lib\db\nic_domain\get::domain_user($domain, \dash\user::id());

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
					'dns'          => $dnsid,
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
			}


			$insert_action =
			[
				'domain_id'      => $domain_id,
				'user_id'        => \dash\user::id(),
				'status'         => 'enable', // 'enable', 'disable', 'deleted', 'expire'
				'action'         => 'transfer', // 'register', 'renew', 'transfer', 'unlock', 'lock', 'changedns', 'updateholder', 'delete', 'expire'
				'mode'           => 'manual', // 'auto', 'manual'
				'detail'         => null,
				'date'           => date("Y-m-d H:i:s"),
				'price'          => $price,
				'discount'       => $transaction_id,
				'transaction_id' => null,
				'datecreated'    => date("Y-m-d H:i:s"),
			];

			$domain_action_id = \lib\db\nic_domainaction\insert::new_record($insert_action);


			\dash\notif::ok(T_("Your domain was transfered"));

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


			\dash\notif::error(T_("Can not transfer this domain"));
			return false;

		}

	}
}
?>