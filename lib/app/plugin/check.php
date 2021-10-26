<?php
namespace lib\app\plugin;


class check
{
	private static $business_plugin_list = [];


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
			$result = \lib\jpi\jpi::plugin_sync();

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
					// can not connect to jpi. Keep current plugin list;
					self::$business_plugin_list = $get_all_plugin_setting;
					return;
				}
			}

			$added_plugin = [];


			$new_plugin_key = array_column($plugin_list, 'plugin_key');

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
					if(a($value, 'plugin_key'))
					{
						self::added_plugin_to_setting($value);
					}
				}
			}
			else
			{
				foreach ($current_plugin as $key => $value)
				{
					if(in_array(a($value, 'key'), $new_plugin_key))
					{
						foreach ($plugin_list as $plugin_detail)
						{
							if(a($value, 'key') === a($plugin_detail, 'plugin_key'))
							{
								$added_plugin[] = $plugin_detail['plugin_key'];

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
				if(!in_array(a($plugin_detail, 'plugin_key'), $added_plugin))
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

		\lib\app\setting\tools::update('plugin', $_data['plugin_key'], $myValue);
	}



	public static function payed($_plugin)
	{

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