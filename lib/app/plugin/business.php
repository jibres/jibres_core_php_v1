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
			$new_list[] =
			[
				'plugin'     => a($value, 'plugin'),
				'status'     => a($value, 'status'),
				'expiredate' => a($value, 'expiredate'),
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


		return $business_plugin_list;

	}


	/**
	 * Load business plugin once
	 * If need sync business plugin by jibres connect to jibres api and get business plugin
	 */
	private static function load_once()
	{
		// check fill once
		if(!empty(self::$business_plugin_list))
		{
			return;
		}

		$get_all_plugin_setting = \lib\app\setting\get::plugin();

		$sync_required = false;

		if(isset($get_all_plugin_setting['synced']) && $get_all_plugin_setting['synced'])
		{
			$synced = $get_all_plugin_setting['synced'];

			if(($sync_time = strtotime($synced)) !== false)
			{
				if(time() - $sync_time > (60*60*24))
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
					self::$business_plugin_list = $get_all_plugin_setting;
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

				$current_plugin[] = $value;
			}

			if(empty($current_plugin))
			{
				foreach ($plugin_list as $key => $value)
				{
					if(a($value, 'plugin'))
					{
						self::added_plugin_to_setting($value);
					}
				}
			}
			else
			{
				foreach ($current_plugin as $key => $value)
				{
					if(in_array(a($value, 'key'), $new_plugin))
					{
						foreach ($plugin_list as $plugin_detail)
						{
							if(a($value, 'key') === a($plugin_detail, 'plugin'))
							{
								$added_plugin[] = $plugin_detail['plugin'];

								self::added_plugin_to_setting($plugin_detail);

							}
						}
					}
					else
					{
						\lib\db\setting\delete::by_cat_key('plugin', a($value, 'key'));
					}
				}
			}

			foreach ($plugin_list as $plugin_detail)
			{
				if(!in_array(a($plugin_detail, 'plugin'), $added_plugin))
				{
					self::added_plugin_to_setting($plugin_detail);
				}
			}

			\lib\app\setting\tools::update('plugin', 'synced', date("Y-m-d H:i:s"));

			\lib\app\setting\tools::update('plugin', 'sync_required', 'no');

			\lib\app\setting\get::reset_setting_cache('plugin');

			$get_all_plugin_setting = \lib\app\setting\get::plugin();
		}

		self::$business_plugin_list = $get_all_plugin_setting;
	}


	private static function added_plugin_to_setting($_data)
	{
		$myValue = a($_data, 'status');

		if(a($_data, 'expiredate'))
		{
			$myValue = $_data['expiredate'];
		}

		\lib\app\setting\tools::update('plugin', $_data['plugin'], $myValue);
	}



	public static function detail($_plugin)
	{
		// not check is active plugin in jibres!
		if(!\dash\engine\store::inStore())
		{
			return false;
		}

		self::load_once();

		if(isset(self::$business_plugin_list[$_plugin]))
		{
			return self::$business_plugin_list[$_plugin];
		}

		return null;
	}



	public static function is_activated($_plugin)
	{
		// not check is active plugin in jibres!
		if(!\dash\engine\store::inStore())
		{
			return false;
		}

		self::load_once();

		if(isset(self::$business_plugin_list[$_plugin]))
		{
			if(self::$business_plugin_list[$_plugin] === 'enable')
			{
				return true;
			}
			elseif(($myTime = strtotime(self::$business_plugin_list[$_plugin])) !== false)
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

		return false;
	}
}
?>