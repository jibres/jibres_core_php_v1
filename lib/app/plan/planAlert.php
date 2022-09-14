<?php

namespace lib\app\plan;

class planAlert
{

	public static function check($_plan_history)
	{
		if(isset($_plan_history['expirydate']) && $_plan_history['expirydate'])
		{
			$expirydate = $_plan_history['expirydate'];
		}
		else
		{
			return false;
		}

		$notifAlert = [];

		if(isset($_plan_history['notifalert']) && $_plan_history['notifalert'])
		{
			if(is_array($_plan_history['notifalert']))
			{
				$notifAlert = $_plan_history['notifalert'];
			}
			elseif(is_string($_plan_history['notifalert']))
			{
				$notifAlert = json_decode($_plan_history['notifalert'], true);
				if(!is_array($notifAlert))
				{
					$notifAlert = [];
				}
			}
		}

		$expireTime = strtotime($expirydate);
		$oneWeek    = strtotime('+1 week');
		$threeDays  = strtotime('+3 days');


		// more than one week to expire date
		if($expireTime > $oneWeek)
		{
			return false;
		}

		$lessThan3Days = false;
		if($expireTime < $threeDays)
		{
			$lessThan3Days = true;
		}


		if(isset($notifAlert['1week']) && $notifAlert['1week'])
		{
			if($lessThan3Days)
			{
				if(isset($notifAlert['3days']) && $notifAlert['3days'])
				{
					return true;
				}
				else
				{
					return self::sendNotif('3days', $notifAlert, $_plan_history);
				}
			}
			else
			{
				return true;
			}
		}
		else
		{
			return self::sendNotif('1week', $notifAlert, $_plan_history);
		}

	}


	private static function sendNotif($_mode, $_notifAlert, $_plan_history)
	{
		$notifAlert = $_notifAlert;

		if(!isset($notifAlert[$_mode]))
		{
			$notifAlert[$_mode] = [];
		}

		$notifAlert[$_mode]['date'] = date("Y-m-d H:i:s");

		if(isset($notifAlert['countAlert']) && is_numeric($notifAlert['countAlert']))
		{
			$notifAlert['countAlert'] = intval($notifAlert['countAlert']) + 1;
		}
		else
		{
			$notifAlert['countAlert'] = 1;
		}

		\lib\db\store_plan_history\update::record(['notifalert' => json_encode($notifAlert)], $_plan_history['id']);

		$log = [];

		$log['store_id'] = $_plan_history['store_id'];
		$log['plan_id']  = $_plan_history['id'];

		switch ($_mode)
		{
			case '3days':
				$log['expiretitle'] = T_("Three days");
				break;

			case '1week':
				$log['expiretitle'] = T_("One days");
				break;

			default:
				return false;
				break;
		}


		$sendTo   = [];
		$sendTo[] = $_plan_history['user_id'];
		$sendTo[] = \lib\app\store\get::owner($_plan_history['store_id']);

		$sendTo = array_filter($sendTo);
		$sendTo = array_unique($sendTo);

		if($sendTo)
		{
			foreach ($sendTo as $to)
			{
				\dash\log::set('plan_expireAlert', ['to' => $to, 'my_data' => $log]);
			}
		}


		return true;
	}


}