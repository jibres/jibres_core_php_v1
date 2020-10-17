<?php
namespace dash\app;


class dayevent
{
	public static function save()
	{
		if(\dash\engine\store::inStore())
		{
			$result = \lib\app\sync\statistics::calc();
		}
		else
		{
			$result = self::jibres_dayevent_calc();
		}

		if(!is_array($result))
		{
			return false;
		}

		$get_today = \dash\db\dayevent::get(['date' => date("Y-m-d"), 'limit' => 1]);

		if(!isset($get_today['id']))
		{
			$result['date']      = date("Y-m-d");
			$result['countcalc'] = 1;
			\dash\db\dayevent::insert($result);
		}
		else
		{
			if(isset($get_today['countcalc']))
			{
				$result['countcalc'] = intval($get_today['countcalc']) + 1;
			}
			else
			{
				$result['countcalc'] = 1;
			}

			\dash\db\dayevent::update($result, $get_today['id']);
		}
	}


	private static function jibres_dayevent_calc()
	{
		$result                           = [];
		$result['user']                   = floatval(\dash\db\users::get_count());
		$result['activeuser']             = floatval(\dash\db\users::get_count(['status' => 'active']));
		$result['deactiveuser']           = floatval(\dash\db\users::get_count(['status' => 'deactive']));
		$result['user_awaiting']          = floatval(\dash\db\users::get_count(['status' => 'awaiting']));
		$result['user_removed']           = floatval(\dash\db\users::get_count(['status' => 'removed']));
		$result['user_filter']            = floatval(\dash\db\users::get_count(['status' => 'filter']));
		$result['user_unreachabl']        = floatval(\dash\db\users::get_count(['status' => 'unreachabl']));

		$result['log']                    = floatval(\dash\db\logs::get_count());
		$result['visitor']                = floatval(\dash\db\visitors::get_count());
		$result['agent']                  = floatval(\dash\db\agents::get_count());
		$result['session']                = floatval(\dash\db\login\get::get_count_all());
		$result['urls']                   = floatval(\dash\db\visitors::url_get_count());
		$result['ticket']                 = floatval(\dash\db\tickets::get_count(['parent' => null]));
		$result['ticket_message']         = floatval(\dash\db\tickets::get_count(['parent' => ['IS NOT', 'NULL']]));
		$result['comment']                = floatval(\dash\db\comments::get_count());
		$result['address']                = floatval(\dash\db\address::get_count());

		$result['news']                   = floatval(\dash\db\posts::get_count(['type' => 'post']));
		$result['page']                   = floatval(\dash\db\posts::get_count(['type' => 'page']));
		$result['help']                   = floatval(\dash\db\posts::get_count(['type' => 'help']));
		$result['attachment']             = floatval(\dash\db\posts::get_count(['type' => 'attachment']));
		$result['post']                   = floatval(\dash\db\posts::get_count(['type' => ['NOT IN ',"('post', 'page', 'help', 'attachment')"]]));

		$result['transaction']            = floatval(\dash\db\transactions::get_count());

		$result['term']                   = floatval(\dash\db\terms::get_count());
		$result['tag']                    = floatval(\dash\db\terms::get_count(['type' => 'tag']));
		$result['cat']                    = floatval(\dash\db\terms::get_count(['type' => 'cat']));
		$result['support_tag']            = floatval(\dash\db\terms::get_count(['type' => 'support_tag']));
		$result['help_tag']               = floatval(\dash\db\terms::get_count(['type' => 'help_tag']));

		$result['termusages']             = floatval(\dash\db\termusages::get_count());

		$result['user_mobile']            = floatval(\dash\db\users::get_count(['mobile' => ['IS NOT', 'NULL']]));
		$result['user_email']             = floatval(\dash\db\users::get_count(['email' => ['IS NOT', 'NULL']]));
		$result['user_username']          = floatval(\dash\db\users::get_count(['username' => ['IS NOT', 'NULL']]));
		$result['user_chatid']            = floatval(\dash\db\user_telegram::get_count());
		$result['user_android']           = floatval(\dash\db\user_android::get_count());

		$result['user_permission']        = floatval(\dash\db\users::get_count(['permission' => ['IS NOT', 'NULL']]));


		$result['apilog']                 = floatval(\dash\db\config::public_get_count('apilog'));
		$result['business_domain']        = floatval(\dash\db\config::public_get_count('business_domain'));
		$result['business_domain_action'] = floatval(\dash\db\config::public_get_count('business_domain_action'));
		$result['business_domain_dns']    = floatval(\dash\db\config::public_get_count('business_domain_dns'));
		$result['csrf']                   = floatval(\dash\db\config::public_get_count('csrf'));
		$result['files']                  = floatval(\dash\db\config::public_get_count('files'));
		$result['fileusage']              = floatval(\dash\db\config::public_get_count('fileusage'));
		$result['gift']                   = floatval(\dash\db\config::public_get_count('gift'));
		$result['giftusage']              = floatval(\dash\db\config::public_get_count('giftusage'));
		$result['log_notif']              = floatval(\dash\db\config::public_get_count('log_notif'));
		$result['login']                  = floatval(\dash\db\config::public_get_count('login'));
		$result['login_ip']               = floatval(\dash\db\config::public_get_count('login_ip'));
		$result['setting']                = floatval(\dash\db\config::public_get_count('setting'));
		$result['store']                  = floatval(\dash\db\config::public_get_count('store'));
		$result['store_analytics']        = floatval(\dash\db\config::public_get_count('store_analytics'));
		$result['store_app']              = floatval(\dash\db\config::public_get_count('store_app'));
		$result['store_data']             = floatval(\dash\db\config::public_get_count('store_data'));
		$result['store_domain']           = floatval(\dash\db\config::public_get_count('store_domain'));
		$result['store_file']             = floatval(\dash\db\config::public_get_count('store_file'));
		$result['store_plan']             = floatval(\dash\db\config::public_get_count('store_plan'));
		$result['store_timeline']         = floatval(\dash\db\config::public_get_count('store_timeline'));
		$result['store_user']             = floatval(\dash\db\config::public_get_count('store_user'));
		$result['telegrams']              = floatval(\dash\db\config::public_get_count('telegrams'));
		$result['user_auth']              = floatval(\dash\db\config::public_get_count('user_auth'));
		$result['user_telegram']          = floatval(\dash\db\config::public_get_count('user_telegram'));
		$result['userdetail']             = floatval(\dash\db\config::public_get_count('userdetail'));
		$result['useremail']              = floatval(\dash\db\config::public_get_count('useremail'));

		$result['nic_contact']            = floatval(\dash\db\config::public_get_count('contact', null, 'nic'));
		$result['nic_contactdetail']      = floatval(\dash\db\config::public_get_count('contactdetail', null, 'nic'));
		$result['nic_credit']             = floatval(\dash\db\config::public_get_count('credit', null, 'nic'));
		$result['nic_dns']                = floatval(\dash\db\config::public_get_count('dns', null, 'nic'));
		$result['nic_domain']             = floatval(\dash\db\config::public_get_count('domain', null, 'nic'));
		$result['nic_domainaction']       = floatval(\dash\db\config::public_get_count('domainaction', null, 'nic'));
		$result['nic_domainbilling']      = floatval(\dash\db\config::public_get_count('domainbilling', null, 'nic'));
		$result['nic_domainstatus']       = floatval(\dash\db\config::public_get_count('domainstatus', null, 'nic'));
		$result['nic_poll']               = floatval(\dash\db\config::public_get_count('poll', null, 'nic'));
		$result['nic_usersetting']        = floatval(\dash\db\config::public_get_count('usersetting', null, 'nic'));

		$result['nic_log_domainactivity'] = floatval(\dash\db\config::public_get_count('domainactivity', null, 'nic_log'));
		$result['nic_log_domains']        = floatval(\dash\db\config::public_get_count('domains', null, 'nic_log'));
		$result['nic_log_log']            = floatval(\dash\db\config::public_get_count('log', null, 'nic_log'));

		$result['onlinenic_log_log']      = floatval(\dash\db\config::public_get_count('log', null, 'onlinenic_log'));

		$result['visitor_ip']             = floatval(\dash\db\config::public_get_count('ip', null, 'visitor'));

		return $result;
	}




	public static function chart($_option = [])
	{
		$fields = [];
		if(isset($_option['field']) && is_array($_option['field']))
		{
			$fields = $_option['field'];
		}

		$result = \dash\db\dayevent::get_all();

		$data       = [];
		$categories = [];

		foreach ($result as $record)
		{
			foreach ($record as $key => $value)
			{
				if(in_array($key, ['id','datecreated', 'datemodified']))
				{
					continue;
				}

				if($fields && !in_array($key, $fields))
				{
					continue;
				}

				if($key === 'date')
				{
					array_push($categories, \dash\datetime::fit($value, null, 'date'));
					continue;
				}

				$temp = null;
				if($value)
				{
					$temp = floatval($value);
				}

				if(!isset($data[$key]))
				{
					$data[$key] = ['name' => T_($key), 'data' => []];
				}

				$data[$key]['data'][] = $temp;
			}
		}

		$data                 = array_values($data);
		$result               = [];
		$result['categories'] = json_encode($categories, JSON_UNESCAPED_UNICODE);
		$result['data']       = json_encode($data, JSON_UNESCAPED_UNICODE);

		return $result;
	}



	public static function day_notif()
	{
		$today         = date("Y-m-d", strtotime("-1 days"));
		$yesterday     = date("Y-m-d", strtotime("-2 days"));

		$get_today     = \dash\db\dayevent::get(['date' => $today, 'limit' => 1]);
		$get_yesterday = \dash\db\dayevent::get(['date' => $yesterday, 'limit' => 1]);

		if(!is_array($get_today) || !is_array($get_yesterday))
		{
			return false;
		}

		$diff    = [];
		$sum_diff = 0;
		foreach ($get_today as $key => $value)
		{
			if(in_array($key, ['dbtrafic', 'dbsize', 'id', 'date', 'countcalc']))
			{
				continue;
			}

			$temp_diff = 0;
			if(array_key_exists($key, $get_yesterday))
			{
				$temp_diff = intval($value) - intval($get_yesterday[$key]);
			}

			if(!$temp_diff || !$value)
			{
				continue;
			}

			$sum_diff += $temp_diff;
			$diff[$key] = ["now" => intval($value), "daydiff" => $temp_diff];
		}

		$diff['sum_diff'] = $sum_diff;

		\dash\log::set('su_dayEventReport', ['result' => $diff]);
	}
}
?>