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
			$price = 12000;
		}

		$domain_id = null;

		$load_domain = \lib\db\nic_domain\get::domain_anyone($domain);
		if(isset($load_domain['id']))
		{
			$domain_id = $load_domain['id'];
		}

		$get_domain_detail = \lib\app\nic_domain\check::info($domain);

		if(!isset($get_domain_detail['exDate']))
		{
			\dash\notif::error(T_("Can not get domain detail from nic server"));
			return false;
		}

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
			'domain'     => $domain,
			'period'     => $period_month,
			'expiredate' => $expiredate,

		];

		$result = \lib\nic\exec\domain_renew::renew($ready);

		if($result && $domain_id)
		{
			$update               = [];
			$update['dateexpire'] = $expiredate;

			$_domain_id = \lib\db\nic_domain\update::update($update, $domain_id);

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