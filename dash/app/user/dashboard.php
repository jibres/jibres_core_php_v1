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

		$last_login = \dash\db\login\get::last_login($user_id);

		$last_login_date = null;
		if(isset($last_login['datecreated']))
		{
			$last_login_date = $last_login['datecreated'];
		}

		$last_login_ip = \dash\db\login\get::last_login_ip($user_id);

		if(isset($last_login_ip['ip']))
		{
			$last_login_ip = $last_login_ip['ip'];
		}
		else
		{
			$last_login_ip = null;
		}

		$last_order        = null;
		$active_order      = null;
		$cart_count        = null;
		$average_order_pay = null;
		$total_order_pay   = null;
		$last_5_order      = [];

		if(\dash\engine\store::inStore())
		{
			$last_order = \lib\db\factors\get::last_order($user_id);

			if(isset($last_order['datecreated']))
			{
				$last_order = $last_order['datecreated'];
			}
			else
			{
				$last_order = null;
			}

			$active_order = \lib\db\factors\get::total_order_user_count($user_id);

			if(!is_numeric($active_order))
			{
				$active_order = 0;
			}

			$cart_count = \lib\db\cart\get::user_cart_count($user_id);

			if(!is_numeric($cart_count))
			{
				$cart_count = 0;
			}

			$average_order_pay = \lib\db\factors\get::average_order_pay_user($user_id);

			if(!is_numeric($average_order_pay))
			{
				$average_order_pay = 0;
			}
			else
			{
				$average_order_pay = round($average_order_pay);
			}

			$total_order_pay = \lib\db\factors\get::total_order_pay_user($user_id);

			if(!is_numeric($total_order_pay))
			{
				$total_order_pay = 0;
			}

			$last_5_order = \lib\app\factor\search::last_user_order($user_id);
		}


		$total_paid = \dash\db\transactions\get::total_paid_user($user_id);

		if(!is_numeric($total_paid))
		{
			$total_paid = 0;
		}

		$last_payment = \dash\db\transactions\get::last_payment_user($user_id);

		if(!is_numeric($last_payment))
		{
			$last_payment = 0;
		}



		$balance = \dash\db\transactions::budget($user_id);

		if(!is_numeric($balance))
		{
			$balance = 0;
		}

		$ticket = \dash\db\tickets\get::count_user_ticket($user_id);

		if(!is_numeric($ticket))
		{
			$ticket = 0;
		}

		$last_5_ticket = \dash\db\tickets\get::last_ticket_user($user_id);
		if(!is_array($last_5_ticket))
		{
			$last_5_ticket = [];
		}

		$last_5_ticket = array_map(['\\dash\\app\\ticket', 'ready'], $last_5_ticket);




		$one_user                      = [];
		$one_user['last_payment']      = $last_payment;
		$one_user['last_login']        = $last_login_date;
		$one_user['last_ip']           = $last_login_ip;
		$one_user['last_order']        = $last_order;
		$one_user['total_paid']        = $total_paid;
		$one_user['cart_count']        = $cart_count;
		$one_user['average_order_pay'] = $average_order_pay;
		$one_user['total_order_pay']   = $total_order_pay;
		$one_user['balance']           = $balance;
		$one_user['active_ticket']     = $ticket;
		$one_user['active_order']      = $active_order;
		$one_user['last_5_ticket']     = $last_5_ticket;
		$one_user['last_5_order']      = $last_5_order;


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
		$dashboard_detail['latestLogs']   = \dash\app\log\search::lates_log_caller('enter_NewAccountLogin');
		$dashboard_detail['latestMember'] = \dash\app\user::lates_user();
		$dashboard_detail['latestTicket'] = \dash\app\ticket\search::last_5_ticket();

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