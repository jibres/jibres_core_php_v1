<?php
namespace lib\app\nic_domain;


class autorenew
{
	public static function run()
	{
		// get all domain with auto renew and less than 1 year left to expire and hour of expire is this hour
		$last_year = date("Y-m-d", strtotime("+365 days"));
		$hour      = date("H");

		$list = \lib\db\nic_domain\get::autorenew_list($last_year, $hour);

		if(empty($list) || !$list || !is_array($list))
		{
			return;
		}

		foreach ($list as $key => $value)
		{
			if(!isset($value['dateexpire']))
			{
				continue;
			}

			$dateexpire      = $value['dateexpire'];
			$autorenewperiod = '1year';
			$domainlifetime  = '1month';

			if(isset($value['autorenewperiod']))
			{
				$autorenewperiod = $value['autorenewperiod'];
			}

			if(isset($value['domainlifetime']))
			{
				$domainlifetime = $value['domainlifetime'];
			}

			$remain_time = strtotime($dateexpire) - time();
			$life_time   = self::get_time($domainlifetime);

			if($remain_time < $life_time)
			{
				// must renew this domain whit $autrenweperiod

			}
		}
	}


	private static function get_time($_key)
	{
		$time = 0;
		switch ($_key)
		{
			case '3day':
				$time = (60*60*24*3);
				break;

			case '1week':
				$time = (60*60*24*7);
				break;

			case '1month':
				$time = (60*60*24*30);
				break;

			case '6month':
				$time = (60*60*24*30*6);
				break;

			case '1year':
				$time = (60*60*24*30*12);
				break;

		}

		return $time;
	}
}
?>