<?php
namespace dash\app\user;


class dashboard
{
	public static function one_user($_user_id)
	{
		$user_id = \dash\coding::decode($_user_id);
		if(!$user_id)
		{
			return false;
		}

		$one_user                      = [];
		$one_user['last_login']        = date("Y-m-d H:i:s", strtotime(time() - rand(1,10000)));
		$one_user['last_order']        = date("Y-m-d H:i:s", strtotime(time() - rand(1,10000)));
		$one_user['last_ip']           = '192.168.1.1';
		$one_user['total_paid']        = rand(5000, 300000);
		$one_user['cart_count']        = rand(1, 500);
		$one_user['average_order_pay'] = rand(5000, 300000);
		$one_user['balance']           = rand(5000, 300000);

		return $one_user;
	}


	/**
	 * Ther master CRM dashboard detail
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function detail()
	{
		$dashboard_detail                 = [];
		$dashboard_detail['users']        = \dash\db\users::get_count();
		$dashboard_detail['permissions']  = count(\dash\permission::groups());
		$dashboard_detail['chart']        = self::chart_transaction();
		$dashboard_detail['success_percent'] = self::transactions_success_percent();
		$dashboard_detail['latestLogs']   = \dash\app\log::lates_log(['caller' => 'enter_NewAccountLogin']);
		$dashboard_detail['latestMember'] = \dash\app\user::lates_user();

		return $dashboard_detail;
	}

	private static function transactions_success_percent()
	{
		$result          = [];
		$result['all']   = self::calc_percent(\dash\db\transactions\get::success_percent());
		$result['today'] = self::calc_percent(\dash\db\transactions\get::success_percent(date("Y-m-d")));
		$result['month'] = self::calc_percent(\dash\db\transactions\get::success_percent(date("Y-m-d", strtotime("-30 days"))));

		return $result;
	}


	private static function calc_percent($_data)
	{
		if(!is_array($_data))
		{
			return 0;
		}

		$verify = 0;
		$unverify = 0;
		foreach ($_data as $key => $value)
		{
			if(isset($value['verify']))
			{
				if($value['verify'] === '1')
				{
					$verify = floatval($value['count']);
				}
				elseif($value['verify'] === '0')
				{
					$unverify = floatval($value['count']);
				}
			}
		}

		$total = $verify + $unverify;
		if(!$total)
		{
			return 0;
		}


		$percent = round(($verify * 100) / $total);

		return $percent;
	}


	private static function chart_transaction()
	{
		$all_date                = [];
		$raw                     = ['verify' => 0, 'unverify' => 0];
		$all_date[date("Y-m-d")] = $raw;

		for ($i = 1; $i < 30; $i++)
		{
			$date         = date("Y-m-d", strtotime("-$i day"));
			$all_date[$date]   = $raw;
			$last_3_month = $date;
		}

		$get_detail   = \dash\db\transactions\get::chart_stack_date($last_3_month);

		if(!is_array($get_detail))
		{
			$get_detail = [];
		}

		foreach ($get_detail as $key => $value)
		{
			if(isset($all_date[$value['datecreated']]))
			{
				if($value['verify'] === '0')
				{
					$all_date[$value['datecreated']]['unverify'] = floatval($value['count']);

				}
				elseif($value['verify'] === '1')
				{
					$all_date[$value['datecreated']]['verify'] = floatval($value['count']);
				}
			}
		}


		$chart             = [];
		$chart['category'] = json_encode(array_map(['\\dash\\fit', 'date'], array_keys($all_date)) , JSON_UNESCAPED_UNICODE);
		$chart['verify']   = json_encode(array_column($all_date, 'verify'), JSON_UNESCAPED_UNICODE);
		$chart['unverify'] = json_encode(array_column($all_date, 'unverify'), JSON_UNESCAPED_UNICODE);
		return $chart;
	}

}
?>