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

		$list = array_map(['\\lib\\app\\nic_domain\\ready', 'row'], $list);

		$not_allow_renew =
		[
			'serverRenewProhibited',
			'pendingDelete',
			'pendingRenew',
			'irnicRegistrationRejected',
			'irnicRegistrationPendingHolderCheck',
			'irnicRegistrationPendingDomainCheck',
			'irnicRegistrationDocRequired',
			'irnicRenewalPendingHolderCheck'
		];

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

			if(isset($value['nicstatus_array']) && is_array($value['nicstatus_array']))
			{
				$continue = false;
				foreach ($not_allow_renew as $not_allow_renew_status)
				{
					if(in_array($not_allow_renew_status, $value['nicstatus_array']))
					{
						$continue = true;
						break;
					}
				}

				if($continue)
				{
					continue;
				}
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
				$domain_id = \dash\coding::decode($value['id']);
				if($domain_id)
				{
					\lib\db\nic_domain\update::update(['datemodified' => date("Y-m-d H:i:s")], $domain_id);
				}

				if(isset($value['lastfetch']) && $value['lastfetch'])
				{
					if(time() - strtotime($value['lastfetch']) > (60*60*24*7))
					{
						\lib\app\nic_domain\get::force_fetch($value['name']);
						// continue;
					}
				}


				$user_budget = floatval(\dash\db\transactions::budget($user_id));

				if(\dash\validate::ir_domain($value['name'], false))
				{
					// must renew this domain whit $autrenweperiod
					$price = \lib\app\nic_domain\price::renew($autorenewperiod, $dateexpire);
				}
				else
				{
					$price = \lib\app\nic_domain\price::renew($value['name'], substr($autorenewperiod, 0, 1));
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

				\dash\log::set('domain_AutoRenewAlert', ['domain_detail' => $renew]);

				if(floatval($price) > $user_budget)
				{
					$renew['auto_status'] = 'failed_price';
					$renew['user_budget_now'] = $user_budget;
					\dash\log::set('domain_AutoRenewAlert', ['domain_detail' => $renew]);
					continue;
				}

				if(\dash\validate::ir_domain($value['name'], false))
				{
					$result = \lib\app\nic_domain\renew::renew($renew);
				}
				else
				{
					$result = \lib\app\onlinenic\renew::renew($renew);
				}

				if($result === false && \dash\temp::get('ji128-irnic-not-allow'))
				{
					$renew['auto_status'] = 'failed';
					\dash\log::set('domain_AutoRenewAlert', ['domain_detail' => $renew]);
				}
				elseif($result)
				{

					$renew['auto_status'] = 'ok';
					\dash\log::set('domain_AutoRenewAlert', ['domain_detail' => $renew]);
				}
				else
				{
					$renew['auto_status'] = 'unknown';
					\dash\log::set('domain_AutoRenewAlert', ['domain_detail' => $renew]);

				}
			}
		}

	}



}
?>