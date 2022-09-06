<?php
namespace lib\app\plugin;

/**
 * This class describes a business.
 */
class business
{
	private static $business_plugin_list = [];


	/**
	 * Only get enable plugin list
 	 * This function call from api r10
	 */
	public static function list($_business_id)
	{
		$business_id = \dash\validate::id($_business_id);

		if(!$business_id)
		{
			return false;
		}

		$business_plugin_list = \lib\db\store_plugin\get::active_by_business_id($business_id);

		if(!is_array($business_plugin_list))
		{
			$business_plugin_list = [];
		}

		$new_list = [];

		foreach ($business_plugin_list as $key => $value)
		{
			$remain_count = null;
			$usage_count  = null;

			$plugin = a($value, 'plugin');

			$plugin_detail = \lib\app\plugin\get::detail($plugin);

			if(a($plugin_detail, 'type') === 'counting_package')
			{
				$usage_count = \lib\db\sms\get::sum_sms_sended_by_package_id($business_id, $value['id']);
				$usage_count = floatval($usage_count);

				$remain_count = floatval(a($value, 'packagecount')) - $usage_count;
			}

			$new_list[] =
			[
				'id'           => a($value, 'id'),
				'plugin'       => $plugin,
				'status'       => a($value, 'status'),
				'expiredate'   => a($value, 'expiredate'),
				'datecreated'  => a($value, 'datecreated'),
				'packagecount' => a($value, 'packagecount'),
				'remaincount'  => $remain_count,
				'usagecount'   => $usage_count,
			];
		}

		return $new_list;
	}


	/**
	 * This function call from api r10
	 */
	public static function sync_required()
	{
		\lib\app\setting\tools::update('plugin', 'sync_required', date("Y-m-d H:i:s"));
		\lib\app\setting\tools::update('plugin', 'synced', null);
	}


	/**
	 * Get all plugin of one business
	 *
	 * @param      <type>  $_business_id  The business identifier
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function admin_list($_business_id)
	{
		$business_id = \dash\validate::id($_business_id);

		if(!$business_id)
		{
			return false;
		}

		$business_plugin_list = \lib\db\store_plugin\get::by_business_id($business_id);

		if(!is_array($business_plugin_list))
		{
			$business_plugin_list = [];
		}

		$business_plugin_list = array_map(['\\lib\\app\\plugin\\action\\ready', 'row'], $business_plugin_list);

		foreach ($business_plugin_list as $key => $value)
		{
			if(a($value, 'plugin') === 'sms_pack' && a($value, 'status') === 'enable')
			{
				$count_usage = \lib\db\sms\get::sum_sms_sended_by_package_id(a($value, 'store_id'), a($value, 'id'));
				$business_plugin_list[$key]['usage'] = floatval($count_usage);
				$business_plugin_list[$key]['remain'] = floatval(a($value, 'packagecount')) - floatval($count_usage);
			}
		}

		return $business_plugin_list;

	}



	public static function load_by_id($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$load = \lib\db\store_plugin\get::by_id($id);

		if(!$load)
		{
			return false;
		}

		$load = \lib\app\plugin\action\ready::row($load);

		return $load;
	}


	/**
	 * Load business plugin once
	 * If need sync business plugin by jibres connect to jibres api and get business plugin
	 */
	private static function load_once($_live_check = false)
	{
		// check fill once
		if(!empty(self::$business_plugin_list) && !$_live_check)
		{
			return;
		}

		// check quick time
		$life_time = (60*60*24);

		if($_live_check)
		{
			$life_time = (60*5);

			if(\dash\url::isLocal())
			{
				$life_time = 1;
			}
		}


		$get_all_plugin_setting = \lib\app\setting\get::plugin_setting();

		$sync_required = false;

		if(isset($get_all_plugin_setting['synced']) && $get_all_plugin_setting['synced'])
		{
			$synced = $get_all_plugin_setting['synced'];

			if(($sync_time = strtotime($synced)) !== false)
			{
				if(time() - $sync_time > $life_time)
				{
					$sync_required = true;
				}
			}
			else
			{
				$sync_required = true;
			}
		}
		else
		{
			$sync_required = true;
		}

		if(isset($get_all_plugin_setting['sync_required']) && $get_all_plugin_setting['sync_required'])
		{
			if($get_all_plugin_setting['sync_required'] === 'no')
			{
				// needless to sync
			}
			else
			{
				$sync_required = true;
			}
		}


		if($sync_required)
		{
			// sync plugin by jibres
			$result = \lib\api\jibres\api::sync_plugin();

			$plugin_list = [];

			if(isset($result['result']) && is_array($result['result']))
			{
				$plugin_list = $result['result'];
			}
			else
			{
				// var_dump($result);exit;
				if(isset($result['ok']) && $result['ok'])
				{
					// ok
				}
				else
				{
					// can not connect to jibres api token. Keep current plugin list;
					self::$business_plugin_list = \lib\app\setting\get::plugin_list();
					return;
				}
			}

			$added_plugin = [];

			$new_plugin = array_column($plugin_list, 'plugin');

			$current_plugin_raw = \lib\db\setting\get::by_cat('plugin');

			$current_plugin = [];

			foreach ($current_plugin_raw as $key => $value)
			{
				if(in_array(a($value, 'key'), ['synced', 'sync_required']))
				{
					continue;
				}

				$myValue = [];

				if(a($value, 'value'))
				{
					$myValue = json_decode($value['value'], true);

					if(!is_array($myValue))
					{
						$myValue = [];
					}
				}

				$myValue['setting_record']        = [];
				$myValue['setting_record']['id']  = a($value, 'id');
				$myValue['setting_record']['cat'] = a($value, 'cat');
				$myValue['setting_record']['key'] = a($value, 'key');


				$current_plugin[] = $myValue;
			}


			$saved_plugin_id = array_column($current_plugin, 'id');

			foreach ($plugin_list as $key => $value)
			{
				$plugin_key = $value['plugin']. '_'. a($value, 'id');

				unset($value['setting_record']);

				$myValue = json_encode($value);

				if(in_array(a($value, 'id'), $saved_plugin_id))
				{
					\lib\app\setting\tools::update('plugin', $plugin_key, $myValue);
				}
				else
				{
					\lib\app\setting\tools::save('plugin', $plugin_key, $myValue);
				}
			}

			$new_plugin_id = array_column($plugin_list, 'id');

			foreach ($current_plugin as $key => $value)
			{
				if(!in_array(a($value, 'id'), $new_plugin_id))
				{
					if(a($value, 'setting_record', 'id'))
					{
						\lib\db\setting\delete::record(a($value, 'setting_record', 'id'));
					}
				}

				// need to remove after update all business data
				if(a($value, 'setting_record', 'key') && !preg_match("/\w+\_\d+/", $value['setting_record']['key']))
				{
					\lib\db\setting\delete::record(a($value, 'setting_record', 'id'));
				}
			}


			\lib\app\setting\tools::update('plugin', 'synced', date("Y-m-d H:i:s"));

			\lib\app\setting\tools::update('plugin', 'sync_required', 'no');

			\lib\app\setting\get::reset_setting_cache('plugin');

		}

		$get_all_plugin_list = \lib\app\setting\get::plugin_list();

		self::$business_plugin_list = $get_all_plugin_list;
	}



	public static function detail($_plugin)
	{
		// not check is active plugin in jibres!
		if(!\dash\engine\store::inStore())
		{
			return false;
		}

		self::load_once();

		$plugin_detail = \lib\app\plugin\get::detail($_plugin);

		foreach (self::$business_plugin_list as $key => $value)
		{
			if($_plugin === a($value, 'plugin'))
			{
				if($plugin_detail['type'] === 'once')
				{
					return $value;
				}
				elseif($plugin_detail['type'] === 'periodic')
				{
					return $value;
				}
				elseif($plugin_detail['type'] === 'counting_package')
				{
					return $value;
				}
			}
		}

		return null;
	}



	public static function is_activated(string $_plugin) : bool
	{
		if(\dash\url::isLocal())
		{
			return \lib\app\plan\planCheck::access($_plugin);
		}


		// not check is active plugin in jibres!
		if(!\dash\engine\store::inStore())
		{
			return false;
		}

		self::load_once();

		$plugin_detail = \lib\app\plugin\get::detail($_plugin);

		foreach (self::$business_plugin_list as $key => $value)
		{
			if($_plugin === a($value, 'plugin'))
			{
				if($plugin_detail['type'] === 'once')
				{
					if($value['status'] === 'enable')
					{
						return true;
					}
					else
					{
						return false;
					}
				}
				elseif($plugin_detail['type'] === 'periodic')
				{
					if(a($value, 'expiredate') && ($myTime = strtotime($value['expiredate'])) !== false)
					{
						if($myTime > time())
						{
							return true;
						}
						else
						{
							return false;
						}
					}
					else
					{
						return false;
					}
				}
				elseif($plugin_detail['type'] === 'counting_package')
				{
					if($value['status'] === 'enable')
					{
						return true;
					}
					else
					{
						return false;
					}
				}
			}
		}


		return false;

	}





	public static function activated_list(string $_plugin)
	{
		// not check is active plugin in jibres!
		if(!\dash\engine\store::inStore())
		{
			return false;
		}

		self::load_once(true);

		$list = [];

		if(is_array(self::$business_plugin_list))
		{
			foreach (self::$business_plugin_list as $key => $value)
			{
				if($_plugin === a($value, 'plugin'))
				{
					$list[] = $value;
				}
			}

		}

		return $list;
	}
}
?>