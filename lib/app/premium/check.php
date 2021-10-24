<?php
namespace lib\app\premium;


class check
{
	private static $business_premium_list = [];


	private static function load_once()
	{
		// check fill once
		if(!empty(self::$business_premium_list))
		{
			return;
		}

		$get_all_premium_setting = \lib\app\setting\get::premium();

		$sync_required = false;

		if(isset($get_all_premium_setting['synced']) && $get_all_premium_setting['synced'])
		{
			$synced = $get_all_premium_setting['synced'];

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

		if(isset($get_all_premium_setting['sync_required']) && $get_all_premium_setting['sync_required'])
		{
			if($get_all_premium_setting['sync_required'] === 'no')
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
			// sync premium by jibres
			$result = \lib\jpi\jpi::premium_sync();

			$premium_list = [];

			if(isset($result['result']) && is_array($result['result']))
			{
				$premium_list = $result['result'];
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
					// can not connect to jpi. Keep current premium list;
					self::$business_premium_list = $get_all_premium_setting;
					return;
				}
			}

			$added_premium = [];


			$new_premium_key = array_column($premium_list, 'premium_key');

			$current_premium_raw = \lib\db\setting\get::by_cat('premium');

			$current_premium = [];

			foreach ($current_premium_raw as $key => $value)
			{
				if(in_array(a($value, 'key'), ['synced', 'sync_required']))
				{
					continue;
				}

				$current_premium[] = $value;
			}

			if(empty($current_premium))
			{
				foreach ($premium_list as $key => $value)
				{
					if(a($value, 'premium_key'))
					{
						self::added_premium_to_setting($value);
					}
				}
			}
			else
			{
				foreach ($current_premium as $key => $value)
				{
					if(in_array(a($value, 'key'), $new_premium_key))
					{
						foreach ($premium_list as $premium_detail)
						{
							if(a($value, 'key') === a($premium_detail, 'premium_key'))
							{
								$added_premium[] = $premium_detail['premium_key'];

								self::added_premium_to_setting($premium_detail);

							}
						}
					}
					else
					{
						\lib\db\setting\delete::by_cat_key('premium', a($value, 'key'));
					}
				}
			}

			foreach ($premium_list as $premium_detail)
			{
				if(!in_array(a($premium_detail, 'premium_key'), $added_premium))
				{
					self::added_premium_to_setting($premium_detail);
				}
			}

			\lib\app\setting\tools::update('premium', 'synced', date("Y-m-d H:i:s"));

			\lib\app\setting\tools::update('premium', 'sync_required', 'no');

			\lib\app\setting\get::reset_setting_cache('premium');

			$get_all_premium_setting = \lib\app\setting\get::premium();
		}

		self::$business_premium_list = $get_all_premium_setting;
	}


	private static function added_premium_to_setting($_data)
	{
		$myValue = a($_data, 'status');

		if(a($_data, 'expiredate'))
		{
			$myValue = $_data['expiredate'];
		}

		\lib\app\setting\tools::update('premium', $_data['premium_key'], $myValue);
	}



	public static function payed($_premium)
	{

		self::load_once();

		if(isset(self::$business_premium_list[$_premium]))
		{
			if(self::$business_premium_list[$_premium] === 'enable')
			{
				return true;
			}
			elseif(($myTime = strtotime(self::$business_premium_list[$_premium])) !== false)
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