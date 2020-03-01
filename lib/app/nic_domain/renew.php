<?php
namespace lib\app\nic_domain;


class renew
{
	public static function renew($_args)
	{

		if(!\dash\user::id())
		{
			return;
		}

		$domain = isset($_args['domain']) 	? $_args['domain'] 	: null;

		$period = isset($_args['period']) 	? $_args['period'] 	: null;

		if(!$domain)
		{
			\dash\notif::error(T_("Please set domain"));
			return false;
		}


		if(!\lib\app\nic_domain\check::syntax_ir($domain))
		{
			\dash\notif::error(T_("Invalid domain syntax, Only ir domain can be renew"));
			return false;
		}

		if(!in_array($period, ['1year', '5year']))
		{
			\dash\notif::error(T_("Please choose your period of renew domain"));
			return false;
		}

		$transaction_id = null;

		$period_month = 0;

		$price = \lib\app\nic_domain\price::renew($period);

		if($period === '1year')
		{
			$period_month = 12;

		}
		elseif($period === '5year')
		{
			$period_month = 5*12;
		}

		$domain_id = null;

		$load_domain = \lib\db\nic_domain\get::domain_user($domain, \dash\user::id());
		if(isset($load_domain['id']))
		{
			$domain_id = $load_domain['id'];
		}
		else
		{
			$insert =
			[
				'user_id'      => \dash\user::id(),
				'name'         => $domain,
				'registrar'    => 'irnic',
				'status'       => 'awaiting',
				'holder'       => null,
				'admin'        => null,
				'tech'         => null,
				'bill'         => null,
				'autorenew'    => null,
				'lock'         => 1,
				'dns'          => null,
				'dateregister' => null,
				'dateexpire'   => null,
				'verify'       => null, // in renew is not verify for this user
				'datecreated'  => date("Y-m-d H:i:s"),
			];

			$domain_id = \lib\db\nic_domain\insert::new_record($insert);
		}

		$get_domain_detail = \lib\app\nic_domain\check::info($domain);

		if(!isset($get_domain_detail['exDate']))
		{
			// \dash\notif::error(T_("Domain is not exists"));
			return false;
		}

		$current_expiredate = date("Y-m-d", strtotime($get_domain_detail['exDate']));

		$current_date_expire      = $get_domain_detail['exDate'];

		$current_date_expire_time = time() - strtotime($current_date_expire);

		$new_date_expire          = strtotime("+$period_month month");

		$new_date_expire          = $current_date_expire_time + $new_date_expire;

		$expiredate               = date("Y-m-d", $new_date_expire);

		$year_6 = time() + (60*60*24*365*6);

		if($new_date_expire >= $year_6)
		{
			\dash\notif::error(T_("Maximum renew date is 6 year"));
			return false;
		}

		if(!isset($get_domain_detail['bill']))
		{
			\dash\notif::error(T_("Can not access to billing account of this domain"));
			return false;
		}

		$get_contac_nic =  \lib\nic\exec\contact_check::check($get_domain_detail['bill']);
		if(!isset($get_contac_nic[$get_domain_detail['bill']]))
		{
			\dash\notif::error(T_("Can not find  billing account detail of this domain"));
			return false;
		}

		$get_contac_nic = $get_contac_nic[$get_domain_detail['bill']];
		if(isset($get_contac_nic['bill']) && $get_contac_nic['bill'] == '1')
		{
			// no problem to renew this domain by tihs contact
		}
		else
		{
			\dash\notif::error(T_("We can not renew this domain because the bill holder of IRNIC can not access to renew"));
			return false;
		}


		$user_budget = \dash\user::budget();

		if($user_budget >= $price)
		{
			$insert_transaction =
			[
				'user_id' => \dash\user::id(),
				'title'   => T_("Renew domian :val", ['val' => $domain]),
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
				'final_fn'      => ['/lib/app/nic_domain/renew', 'renew'],
				'final_fn_args' => $temp_args,
			];

			\dash\utility\pay\start::site($meta);

			// redirect to bank payment
			return ;

		}


		$ready =
		[
			'domain'             => $domain,
			'period'             => $period_month,
			'expiredate'         => $expiredate,
			'current_expiredate' => $current_expiredate,

		];

		$result = \lib\nic\exec\domain_renew::renew($ready);

		if($result && $domain_id)
		{
			$update               = [];
			$update['dateexpire'] = $expiredate;
			$update['status']     = 'enable';

			\lib\db\nic_domain\update::update($update, $domain_id);

			$insert_action =
			[
				'domain_id'      => $domain_id,
				'user_id'        => \dash\user::id(),
				'status'         => 'enable', // 'enable', 'disable', 'deleted', 'expire'
				'action'         => 'renew', // 'register', 'renew', 'transfer', 'unlock', 'lock', 'changedns', 'updateholder', 'delete', 'expire'
				'mode'           => 'manual', // 'auto', 'manual'
				'detail'         => null,
				'date'           => date("Y-m-d H:i:s"),
				'price'          => $price,
				'discount'       => $transaction_id,
				'transaction_id' => null,
				'datecreated'    => date("Y-m-d H:i:s"),
			];

			$domain_action_id = \lib\db\nic_domainaction\insert::new_record($insert_action);




			\dash\notif::ok(T_("Domain renew ok"));
			return true;

		}
		else
		{
			// need to back money
			$insert_transaction =
			[
				'user_id' => \dash\user::id(),
				'title'   => T_("Renew failed :val", ['val' => $domain]),
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

			\dash\notif::error(T_("Can not renew your domain"));
			return false;
		}



	}
}
?>