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


		if(!\lib\app\nic_domain\check::syntax($domain))
		{
			\dash\notif::error(T_("Invalid domain syntax"));
			return false;
		}

		if(!in_array($period, ['1year', '5year']))
		{
			\dash\notif::error(T_("Invalid period"));
			return false;
		}

		$period_month = 0;

		if($period === '1year')
		{
			$period_month = 12;
		}
		elseif($period === '5year')
		{
			$period_month = 5*12;
		}

		$expiredate = date("Y-m-d", strtotime("+$period_month month"));

		$ready =
		[
			'domain' => $domain,
			'period' => $period_month,
			'expiredate' => $expiredate,

		];

		$load_domain = \lib\db\nic_domain\get::domain_user($domain, \dash\user::id());
		if(!isset($load_domain['id']))
		{
			\dash\notif::error(T_("Invalid domain"));
			return false;
		}

		$result = \lib\nic\exec\domain_renew::renew($ready);


		if($result)
		{
			$update               = [];
			$update['dateexpire'] = $expiredate;

			$_domain_id = \lib\db\nic_domain\update::update($update, $load_domain['id']);

			\dash\notif::ok(T_("Domain renew ok"));
			return true;

		}

		\dash\notif::error(T_("Can not renew your domain"));
		return false;


	}
}
?>