<?php
namespace lib\app\nic_domain;


class autorenew
{
	public static function run()
	{
		foreach (['1month'] as $date)
		{
			$args =
			[
				'predict'        => true,
				'autorenew_mode' => $date,
				'autorenew_notif' => 'yes',
			];

			$list = \lib\app\nic_domain\search::get_list(null, $args);

			if($list && is_array($list))
			{
				self::set_notif($list, $date);
			}
		}


		foreach (['1month'] as $date)
		{
			$args =
			[
				'predict'        => true,
				'autorenew_mode' => $date,
				'autorenew_notif' => 'no',
			];

			$list = \lib\app\nic_domain\search::get_list(null, $args);

			if($list && is_array($list))
			{
				self::fire_renew($list, $date);
			}

		}
	}

	private static function fire_renew($_list, $_mode)
	{
		foreach ($_list as $key => $value)
		{
			if(\dash\validate::ir_domain($value['name'], false))
			{
				$is_ir = true;
				$autorenewperiod = $value['autorenewperiod'];
			}
			else
			{
				$is_ir = false;
				$autorenewperiod = '1year';
			}

			if(!$autorenewperiod)
			{
				$autorenewperiod = '1year';
			}

			$dateexpire      = $value['dateexpire'];
			$user_id         = $value['owner'];
			$domain_id = $value['myid'];

			\lib\db\nic_domain\update::record(['renewtry' => date("Y-m-d H:i:s")], $value['myid']);

			$user_budget = floatval(\dash\db\transactions::budget($user_id));

			if($is_ir)
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

			$log =
			[
				'to'              => $value['owner'],
				'my_action'       => 'exec',
				'my_domain'       => $value['name'],
				'my_domain_id'    => $value['myid'],
				'my_expredate'    => $value['dateexpire'],
				'my_mode'         => $_mode,
				'my_budget'       => $user_budget,
				'my_price'        => $price,
				'my_renew_detail' => $renew,
			];


			if(floatval($price) > $user_budget)
			{
				$log['my_status'] = 'low_budget';

				\dash\log::set('domain_AutoRenewAlert', $log);

				// set domain action
				$domain_action_detail =
				[
					'domain_id'      => $domain_id,
				];

				\lib\app\nic_domainaction\action::set('autorenew_failed', $domain_action_detail);

				continue;
			}

			if($is_ir)
			{
				$result = \lib\app\nic_domain\renew::renew($renew);
			}
			else
			{
				$result = \lib\app\onlinenic\renew::renew($renew);
			}

			if($result === false && \dash\temp::get('ji128-irnic-not-allow'))
			{
				$log['my_status'] = 'failed';
			}
			elseif($result)
			{
				\lib\db\nic_domain\update::record(['renewnotif' => null, 'renewtry' => null], $value['myid']);
				$log['my_status'] = 'ok';
			}
			else
			{
				$log['my_status'] = 'unknown';
			}

			\dash\log::to_supervisor('Auto renew for domain '. $value['name']);

			\dash\log::set('domain_AutoRenewAlert', $log);

		}

	}



	private static function set_notif($_list, $_mode)
	{
		foreach ($_list as $key => $value)
		{
			$user_budget = floatval(\dash\db\transactions::budget($value['owner']));

			if(\dash\validate::ir_domain($value['name'], false))
			{
				// must renew this domain whit $autrenweperiod
				$price = \lib\app\nic_domain\price::renew($value['autorenewperiod'], $value['dateexpire']);
			}
			else
			{
				$price = \lib\app\nic_domain\price::renew($value['name'], substr($value['autorenewperiod'], 0, 1));
			}

			$log =
			[
				'to'             => $value['owner'],
				'my_action'      => 'notif',
				'my_domain'      => $value['name'],
				'my_domain_id'   => $value['myid'],
				'my_expredate'   => $value['dateexpire'],
				'my_mode'        => $_mode,
				'my_budget'      => $user_budget,
				'my_price'       => $price,
				'my_renew_is_ok' => $price <= $user_budget,
			];

			\dash\log::set('domain_AutoRenewAlert', $log);

			\lib\db\nic_domain\update::record(['renewnotif' => date("Y-m-d H:i:s")], $value['myid']);
		}

	}



}
?>