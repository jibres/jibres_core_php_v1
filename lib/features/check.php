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
			// ok
		}
		else
		{
			$sync_required = true;
		}

		if(isset($get_all_feature_setting['sync_required']) && $get_all_feature_setting['sync_required'])
		{
			$sync_required = true;
		}



		if($sync_required)
		{
			// sync features by jibres
			$list = \lib\jpi\features::sync();

			$features_list = [];

			if(isset($list['result']) && is_array($list['result']))
			{
				$features_list = $list['result'];
			}
			else
			{
				// var_dump($list);exit;
				if(isset($list['ok']) && $list['ok'])
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

			\lib\db\setting\delete::by_cat('features');

			foreach ($features_list as $key => $value)
			{
				if(a($value, 'feature_key'))
				{
					$myValue = a($value, 'status');

					if(a($value, 'expiredate'))
					{
						$myValue = $value['expiredate'];
					}

					\lib\app\setting\tools::update('features', $value['feature_key'], $myValue);
				}
			}

			\lib\app\setting\tools::update('features', 'synced', 1);

			\lib\db\setting\delete::by_cat_key('features', 'sync_required');

			\lib\app\setting\get::reset_setting_cache('features');

			$get_all_feature_setting = \lib\app\setting\get::features();
		}

		self::$business_feature_list = $get_all_feature_setting;
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