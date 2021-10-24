<?php
namespace lib\features;


class check
{
	private static $business_feature_list = [];


	private static function load_once()
	{
		// check fill once
		if(!empty(self::$business_feature_list))
		{
			return;
		}

		$get_all_feature_setting = \lib\app\setting\get::features();

		$sync_required = false;

		if(isset($get_all_feature_setting['synced']) && $get_all_feature_setting['synced'])
		{
			$synced = $get_all_feature_setting['synced'];

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

		if(isset($get_all_feature_setting['sync_required']) && $get_all_feature_setting['sync_required'])
		{
			if($get_all_feature_setting['sync_required'] === 'no')
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
			// sync features by jibres
			$result = \lib\jpi\jpi::features_sync();

			$features_list = [];

			if(isset($result['result']) && is_array($result['result']))
			{
				$features_list = $result['result'];
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
					// can not connect to jpi. Keep current features list;
					self::$business_feature_list = $get_all_feature_setting;
					return;
				}
			}

			$added_features = [];


			$new_features_key = array_column($features_list, 'feature_key');

			$current_features_raw = \lib\db\setting\get::by_cat('features');

			$current_features = [];

			foreach ($current_features_raw as $key => $value)
			{
				if(in_array(a($value, 'key'), ['synced', 'sync_required']))
				{
					continue;
				}

				$current_features[] = $value;
			}

			if(empty($current_features))
			{
				foreach ($features_list as $key => $value)
				{
					if(a($value, 'feature_key'))
					{
						self::added_feature_to_setting($value);
					}
				}
			}
			else
			{
				foreach ($current_features as $key => $value)
				{
					if(in_array(a($value, 'key'), $new_features_key))
					{
						foreach ($features_list as $feature_detail)
						{
							if(a($value, 'key') === a($feature_detail, 'feature_key'))
							{
								$added_features[] = $feature_detail['feature_key'];

								self::added_feature_to_setting($feature_detail);

							}
						}
					}
					else
					{
						\lib\db\setting\delete::by_cat_key('features', a($value, 'key'));
					}
				}
			}

			foreach ($features_list as $feature_detail)
			{
				if(!in_array(a($feature_detail, 'feature_key'), $added_features))
				{
					self::added_feature_to_setting($feature_detail);
				}
			}

			\lib\app\setting\tools::update('features', 'synced', date("Y-m-d H:i:s"));

			\lib\app\setting\tools::update('features', 'sync_required', 'no');

			\lib\app\setting\get::reset_setting_cache('features');

			$get_all_feature_setting = \lib\app\setting\get::features();
		}

		self::$business_feature_list = $get_all_feature_setting;
	}


	private static function added_feature_to_setting($_data)
	{
		$myValue = a($_data, 'status');

		if(a($_data, 'expiredate'))
		{
			$myValue = $_data['expiredate'];
		}

		\lib\app\setting\tools::update('features', $_data['feature_key'], $myValue);
	}



	public static function payed($_feature)
	{

		self::load_once();

		if(isset(self::$business_feature_list[$_feature]))
		{
			if(self::$business_feature_list[$_feature] === 'enable')
			{
				return true;
			}
			elseif(($myTime = strtotime(self::$business_feature_list[$_feature])) !== false)
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