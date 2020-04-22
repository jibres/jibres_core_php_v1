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

			if(!isset($value['user_id']))
			{
				continue;
			}

			if(!isset($value['name']))
			{
				continue;
			}

			$dateexpire = $value['dateexpire'];
			$user_id    = $value['user_id'];

			$autorenewperiod = \lib\app\nic_usersetting\defaultval::autorenewperiod();

			$domainlifetime = \lib\app\nic_usersetting\defaultval::domainlifetime();


			if(isset($value['autorenewperiod']))
			{
				$autorenewperiod = $value['autorenewperiod'];
			}

			if(isset($value['domainlifetime']))
			{
				$domainlifetime = $value['domainlifetime'];
			}

			$remain_time = strtotime($dateexpire) - time();
			$life_time   = \lib\app\nic_usersetting\defaultval::get_time($domainlifetime);

			if($remain_time < $life_time)
			{
				// must renew this domain whit $autrenweperiod
				$price = \lib\app\nic_domain\price::renew($autorenewperiod);

				$user_budget = floatval(\dash\db\transactions::budget($user_id));

				if(floatval($price) > $user_budget)
				{
					// save action log
					continue;
				}


				$renew =
				[
					'user_id'              => $user_id,
					'domain'               => $value['name'],
					'period'               => $autorenewperiod,
					'agree'                => true,
					'register_now'         => true,
					'usebudget'            => true,
				];

				$result = \lib\app\nic_domain\renew::renew($renew);
				if($result === false && \dash\temp::get('ji128-irnic-not-allow'))
				{
					// save log
				}

				if($result)
				{
					// save log
				}

			}
		}
	}



}
?>