<?php
namespace lib\app\nic_domain;


class notif_expire
{
	public static function run()
	{
		// get list of domains by expire 7 days late and auto renew is off
		$next_week = date("Y-m-d", strtotime("+7 days"));
		$expire_next_week = \lib\db\nic_domain\get::notif_expire($next_week);

		$log = [];

		if(!empty($expire_next_week))
		{
			self::ready_notif($expire_next_week, 'domain_expireDomainInNextWeek', $log);
		}


		$next_week = date("Y-m-d", strtotime("+1 days"));
		$expire_next_day = \lib\db\nic_domain\get::notif_expire($next_week);

		$log = [];

		if(!empty($expire_next_day))
		{
			self::ready_notif($expire_next_day, 'domain_expireDomainInNextDay', $log);
		}

	}



	private static function ready_notif($_domain_list, $_caller, $_log_meta)
	{
		$result = [];
		foreach ($_domain_list as $key => $domain)
		{
			if(!isset($domain['user_id']))
			{
				continue;
			}

			$user_id = $domain['user_id'];

			if(!isset($result[$user_id]))
			{
				$result[$user_id] = [];
			}

			$result[$user_id][] = ['domain' => $domain['name']];
		}

		foreach ($result as $user_id => $domains)
		{
			$log_meta       = $_log_meta;
			$log_meta['to'] = $user_id;
			$log_meta['domains_list'] = $domains;
			\dash\log::set($_caller,$log_meta);
		}

	}
}
?>