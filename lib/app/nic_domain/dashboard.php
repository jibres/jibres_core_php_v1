<?php
namespace lib\app\nic_domain;


class dashboard
{
	public static function admin()
	{
		\dash\permission::access('showDomainStats');

		$today      = date("Y-m-d");
		$yesterday  = date("Y-m-d", strtotime("yesterday"));
		$last_week  = date("Y-m-d", strtotime("-1 week"));
		$last_month = date("Y-m-d", strtotime("-1 month"));


		$result                          = [];
		$result['sale_count_today']      = \lib\db\nic_domainbilling\get::sale_count_date($today);
		$result['sale_count_yesterday']  = \lib\db\nic_domainbilling\get::sale_count_date($yesterday);
		$result['sale_count_last_week']  = \lib\db\nic_domainbilling\get::sale_count_date($last_week);
		$result['sale_count_last_month'] = \lib\db\nic_domainbilling\get::sale_count_date($last_month);
		$result['sale_count_total']      = \lib\db\nic_domainbilling\get::sale_count_date();


		$result['total_buyers']          = \lib\db\nic_domainaction\get::total_buyers();
		$result['total_log']             = \lib\db\nic_log\get::count_all();

		$group_by_action                 = \lib\db\nic_domainbilling\get::count_group_by_action();

		$result['total_domain_buy']      = isset($group_by_action['register']) ? $group_by_action['register'] : null;
		$result['total_domain_renew']    = isset($group_by_action['renew']) ? $group_by_action['renew'] : null;
		$result['total_domain_transfer'] = isset($group_by_action['transfer']) ? $group_by_action['transfer'] : null;
		$result['total_domain_whois']    = \lib\db\domains\get::count_all();

		$result['domain_action_chart']   = self::domain_action_chart($last_month);
		$result['domain_log_chart']      = self::domain_log_chart($last_month);


		return $result;
	}


	public static function user()
	{
		if(!\dash\user::id())
		{
			return false;
		}

		$user_id = \dash\user::id();

		$result                          = [];
		$result['maybe_my_domain']   = intval(\lib\db\nic_domain\get::maybe_my_domain_count($user_id));
		$result['available_domain'] = intval(\lib\db\nic_domain\get::my_available_count($user_id));
		$result['my_domain']      = intval(\lib\db\nic_domain\get::my_active_count($user_id));

		$count_autorenew = intval(\lib\db\nic_domain\get::my_autorenew_count($user_id));

		$count_lock = intval(\lib\db\nic_domain\get::my_lock_count($user_id));

		$my_all = $result['my_domain'];
		if(!$my_all)
		{
			$my_all = 1;
		}

		$my_active_domain = (floatval($result['my_domain']) +  floatval($result['maybe_my_domain']));
		if(!$my_active_domain)
		{
			$my_active_domain = 1;
		}

		$result['domain_autorenew_percent'] = round($count_autorenew * 100 / $my_active_domain);
		$result['domain_lock_percent']      = round($count_lock * 100 / $my_all);
		$result['domain_active_percent']    = round($result['my_domain'] * 100 / $my_active_domain);
		$result['user_budget']              = \dash\user::budget();
		$result['user_unit']         = T_("Toman");

		$last_year = date("Y-m-d", strtotime("-365 days"));

		$result['total_payment']        = intval(\lib\db\nic_domainbilling\get::my_total_payed($user_id));
		$result['last_year_payment']    = intval(\lib\db\nic_domainbilling\get::my_total_payed($user_id, $last_year));


		$predict_late_payment = 0;

		$get_setting = \lib\db\nic_usersetting\get::my_setting($user_id);

		if(isset($get_setting['autorenewperiod']))
		{
			$autorenewperiod = $get_setting['autorenewperiod'];
		}
		else
		{
			$autorenewperiod = \lib\app\nic_usersetting\defaultval::autorenewperiod();
		}

		if(isset($get_setting['domainlifetime']))
		{
			$domainlifetime = $get_setting['domainlifetime'];
		}
		else
		{
			$domainlifetime = \lib\app\nic_usersetting\defaultval::domainlifetime();
		}

		$life_time   = \lib\app\nic_usersetting\defaultval::get_time($domainlifetime);

		$next_year = date("Y-m-d", strtotime("+365 days") - $life_time);


		$count_expire_domain_next_year = intval(\lib\db\nic_domain\get::count_expire_domain_date($user_id, $next_year));
		if($count_expire_domain_next_year)
		{
			$price = \lib\app\nic_domain\price::renew($autorenewperiod);
			$predict_late_payment = $price * $count_expire_domain_next_year;
		}

		$result['predict_late_payment'] = $predict_late_payment;

		// $result['domain_pay_chart']      = self::domain_pay_chart($user_id);
		$result['domain_pay_chart']      = self::domain_pay_chart_day($user_id);


		return $result;
	}

	public static function count_group_by_status_nic()
	{

		if(!\dash\user::id())
		{
			return false;
		}

		$user_id = \dash\user::id();

		$list = \lib\db\nic_domain\get::count_group_by_nic_status($user_id);

		return $list;
	}

	public static function count_group_by_status()
	{

		if(!\dash\user::id())
		{
			return false;
		}

		$user_id = \dash\user::id();

		$result              = [];
		$result['mydomain']  = floatval(\lib\db\nic_domain\get::my_active_count($user_id));
		$result['maybe']     = floatval(\lib\db\nic_domain\get::maybe_my_domain_count($user_id));
		$result['available'] = floatval(\lib\db\nic_domain\get::my_available_count($user_id));
		$result['imported'] = floatval(\lib\db\nic_domain\get::my_imported_count($user_id));


		return $result;
	}


	private static function domain_pay_chart($_user_id)
	{
		$list = \lib\db\nic_domainbilling\get::chart_my_pay($_user_id);

		$start_date = date("Y-m", strtotime("2020-01"));

		$end_date   = date("Y-m");

		$datetime1  = date_create($start_date);
		$datetime2  = date_create($end_date);

		$interval   = date_diff($datetime1, $datetime2);

		$diff_month = $interval->format("%m");


		$my_list = [];
		foreach ($list as $key => $value)
		{
			if(isset($value['year']) && isset($value['month']) && isset($value['price']))
			{
				$my_list[$value['year']. '-'. str_pad($value['month'], 2, "0", STR_PAD_LEFT)] = $value['price'];
			}
		}

		$result = [];

	    for ($i = 0; $i < intval($diff_month) + 1 ; $i++)
	    {
	    	$new_date = date("Y-m", strtotime("+$i month", strtotime($start_date)));
	    	if(isset($my_list[$new_date]))
	    	{
	    		$result[$new_date] = intval($my_list[$new_date]);
	    	}
	    	else
	    	{
	    		$result[$new_date] = 0;
	    	}
	    }

		$hi_chart               = [];
		$hi_chart['categories'] = json_encode(array_keys($result), JSON_UNESCAPED_UNICODE);
		$hi_chart['price']      = json_encode(array_values($result), JSON_UNESCAPED_UNICODE);

		return $hi_chart;

	}




	private static function domain_pay_chart_day($_user_id)
	{
		$list = \lib\db\nic_domainbilling\get::chart_my_pay_per_day($_user_id);


		$start_date = date("Y-m-d", strtotime("2020-04-01"));

		$end_date   = date("Y-m-d");

		$datetime1  = date_create($start_date);
		$datetime2  = date_create($end_date);

		$interval   = date_diff($datetime1, $datetime2);

		$diff_day = 0;
		if(isset($interval->days))
		{
			$diff_day = $interval->days;
		}


		$my_list = [];
		foreach ($list as $key => $value)
		{
			if(isset($value['mydate']) && isset($value['price']))
			{
				$my_list[$value['mydate']] = $value['price'];
			}
		}

		$result = [];

	    for ($i = 0; $i < intval($diff_day) + 1 ; $i++)
	    {
	    	$new_date = date("Y-m-d", strtotime("+$i days", strtotime($start_date)));
	    	if(isset($my_list[$new_date]))
	    	{
	    		$result[$new_date] = intval($my_list[$new_date]);
	    	}
	    	else
	    	{
	    		$result[$new_date] = 0;
	    	}
	    }

		$hi_chart               = [];
		$hi_chart['categories'] = json_encode(array_map(['\\dash\\fit', 'date'], array_keys($result)), JSON_UNESCAPED_UNICODE);
		$hi_chart['price']      = json_encode(array_values($result), JSON_UNESCAPED_UNICODE);

		return $hi_chart;

	}


	private static function domain_action_chart($_date)
	{
		$list = \lib\db\nic_domainbilling\get::chart_domain_action($_date);

		$hi_chart               = [];
		$hi_chart['categories'] = [];
		$hi_chart['register']   = [];
		$hi_chart['renew']      = [];
		$hi_chart['transfer']   = [];

		$all_date = array_column($list, 'date');
		$all_date = array_unique($all_date);
		$all_date = array_filter($all_date);

		asort($all_date);

		$new_all_date = [];

		$start_date = current($all_date);
		$end_date = end($all_date);

		$start_date = date("Y-m-d", strtotime($start_date));
		// $end_date   = date("Y-m-d", strtotime($end_date));
		$end_date   = date("Y-m-d");

		$datetime1  = date_create($start_date);
		$datetime2  = date_create($end_date);

		$interval   = date_diff($datetime1, $datetime2);

		$diff_days = $interval->format("%d");

	    for ($i = 0; $i < intval($diff_days) + 1 ; $i++)
	    {
	    	$new_date = date("Y-m-d", strtotime("+$i days", strtotime($start_date)));
	    	$new_all_date[] = $new_date;
	    }

	    $all_date = $new_all_date;


		$result             = [];
		$result['register'] = [];
		$result['renew']    = [];
		$result['transfer'] = [];


		$new_list             = [];
		$new_list['register'] = [];
		$new_list['renew']    = [];
		$new_list['transfer'] = [];



		foreach ($list as $key => $value)
		{
			if(isset($value['action']) && isset($new_list[$value['action']]))
			{
				$new_list[$value['action']][$value['date']] = $value['count'];
			}
		}

		foreach ($all_date as $key => $one_date)
		{
			if(isset($new_list['register'][$one_date]))
			{
				$result['register'][$one_date] = intval($new_list['register'][$one_date]);
			}
			else
			{
				$result['register'][$one_date] = 0;
			}

			if(isset($new_list['renew'][$one_date]))
			{
				$result['renew'][$one_date] = intval($new_list['renew'][$one_date]);
			}
			else
			{
				$result['renew'][$one_date] = 0;
			}

			if(isset($new_list['transfer'][$one_date]))
			{
				$result['transfer'][$one_date] = intval($new_list['transfer'][$one_date]);
			}
			else
			{
				$result['transfer'][$one_date] = 0;
			}
		}

		foreach ($all_date as $key => $value)
		{
			$all_date[$key] = \dash\fit::date($value);
		}


		$hi_chart['categories'] = json_encode($all_date, JSON_UNESCAPED_UNICODE);
		$hi_chart['register']   = json_encode(array_values($result['register']), JSON_UNESCAPED_UNICODE);
		$hi_chart['renew']      = json_encode(array_values($result['renew']), JSON_UNESCAPED_UNICODE);
		$hi_chart['transfer']   = json_encode(array_values($result['transfer']), JSON_UNESCAPED_UNICODE);

		return $hi_chart;

	}



	private static function domain_log_chart($_date)
	{
		$list = \lib\db\nic_log\get::chart_per_day($_date);


		$hi_chart               = [];
		$hi_chart['categories'] = [];
		$hi_chart['count']      = [];


		foreach ($list as $key => $value)
		{
			if(isset($value['date']))
			{
				array_push($hi_chart['categories'], \dash\fit::date($value['date']));
				array_push($hi_chart['count'], intval($value['count']));
			}
		}

		$hi_chart['categories'] = json_encode($hi_chart['categories'], JSON_UNESCAPED_UNICODE);
		$hi_chart['count'] = json_encode($hi_chart['count'], JSON_UNESCAPED_UNICODE);

		return $hi_chart;

	}
}
?>