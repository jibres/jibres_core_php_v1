<?php
namespace lib;

/**
 * Class for store.
 */
class store
{
	private static $life_time  = 60 * 3;

	private static $store      = [];

	private static $store_slug = null;


	// clean session and init again store detail
	public static function refresh()
	{
		$store_id = self::id();
		if($store_id)
		{
			self::clean();
			self::init();
		}
	}


	public static function clean_session($_slug)
	{
		$key = 'store_slug_checker';
		$old_session_key = \dash\session::get($key);

		if($old_session_key !== $_slug)
		{
			\dash\session::clean('store_detail_'. $old_session_key);
			\dash\session::clean('staff_list_'. $old_session_key);
			\dash\session::clean_cat('jibres_store');

			self::$store        = [];

			\dash\session::set($key, $_slug);
		}
	}

	/**
	 * clean chach to load detail again
	 * user in edit store
	 */
	public static function clean()
	{
		$addr = \dash\engine\store::setting_addr(). self::id();
		if(is_file($addr))
		{
			\dash\file::delete($addr);
		}

		\dash\session::set('store_detail_'. self::store_slug(), null);

		self::$store = [];
	}



	// in api no user can set subdomain
	public static function store_slug()
	{
		if(\dash\url::store())
		{
			return \dash\url::store();
		}
		elseif(\dash\url::subdomain())
		{
			if(\dash\engine\store::free_subdomain())
			{
				return null;
			}
			else
			{
				return \dash\url::subdomain();
			}
		}
		elseif(\dash\engine\store::inCustomerDomain())
		{
			return \dash\url::domain();
		}
	}



	/**
	 * initial store detail
	 */
	public static function init()
	{
		// no subdomain and no domains
		if(!self::store_slug())
		{
			return;
		}

		if(!empty(self::$store))
		{
			return;
		}

		$store_session_key = 'store_detail_'. self::store_slug();

		if(\dash\session::get($store_session_key))
		{
			self::$store = \dash\session::get($store_session_key);
			self::$store['store_data'] = self::file_store_data(self::$store);
			return;
		}

		self::clean_session(self::store_slug());

		$store_detail_file = [];

		$store_id = \dash\engine\store::store_detail();
		if(isset($store_id['id']) && is_numeric($store_id['id']))
		{
			$store_detail_file = \dash\engine\store::init_by_id($store_id['id']);
		}

 		// no file founded an no record existe in jibres database
 		if(!$store_detail_file || !isset($store_detail_file['store']))
 		{
 			return false;
 		}

 		$store_detail = $store_detail_file['store'];

		self::$store = $store_detail;

		\dash\session::set($store_session_key, $store_detail);

		self::$store['store_data'] = self::file_store_data(self::$store);
	}


	/**
	 * Check user is inserted to current database user or no
	 * where supervisor check the store the supervisor not in_stroe and can not add or edit any thing
	 */
	public static function in_store()
	{
		if(\dash\user::is_init_store_user())
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	public static function get_last_update()
	{
		$addr = \dash\engine\store::setting_addr(). self::id();

		if(is_file($addr))
		{
			$getFile = \dash\file::read($addr);
			if($getFile && is_string($getFile))
			{
				$getFile = json_decode($getFile, true);
			}

			if($getFile['update_time'] && is_numeric($getFile['update_time']))
			{
				return date("Y-m-d H:i:s", intval($getFile['update_time']));
			}
		}

		return null;

	}


	private static function file_store_data($_store_detail)
	{
		if(!isset($_store_detail['id']))
		{
			return false;
		}

		$addr = \dash\engine\store::setting_addr(). $_store_detail['id'];

		if(is_file($addr))
		{
			$getFile = \dash\file::read($addr);
			if($getFile && is_string($getFile))
			{
				$getFile = json_decode($getFile, true);
			}

			if(is_array($getFile) && $getFile)
			{
				if(isset($getFile['title']))
				{
					if(isset($getFile['update_time']) && time() - intval($getFile['update_time']) > 60)
					{
						return self::store_detail_setting_record($_store_detail['id']);
					}
					else
					{
						return self::ready_setting($getFile);
					}
				}
				else
				{
					return self::store_detail_setting_record($_store_detail['id']);
				}

			}
			else
			{
				return self::store_detail_setting_record($_store_detail['id']);
			}
		}
		else
		{
			return self::store_detail_setting_record($_store_detail['id']);
		}

	}


	/**
	 * get store setting from database
	 */
	private static function store_detail_setting_record($_store_id)
	{

		$store_detail_setting_record = \lib\app\setting\tools::get_cat('store_setting');

		if(!is_array($store_detail_setting_record))
		{
			$store_detail_setting_record = [];
		}

		$result = [];

		foreach ($store_detail_setting_record as $key => $value)
		{
			if(array_key_exists('key', $value) && array_key_exists('value', $value))
			{
				if($value['key'] === 'domain')
				{
					if(!isset($result['domain']))
					{
						$result['domain'] = [];
					}

					$result['domain'][] = ['domain' => $value['value']];
				}
				else
				{
					$result[$value['key']] = $value['value'];
				}
			}
		}


		if(array_key_exists('logo', $result) && !$result['logo'])
		{
			$result['logo'] = \dash\app::static_logo_url();
		}


		$addr = \dash\engine\store::setting_addr();
		if(!is_dir($addr))
		{
			\dash\file::makeDir($addr, null, true);
		}
		$addr .= $_store_id;

		$result['update_time'] = time();
		\dash\file::write($addr, json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

		return self::ready_setting($result);
	}




	private static function ready_setting($_data)
	{
		if(!is_array($_data))
		{
			return null;
		}

		if(!isset($_data['logo']))
		{
			$_data['logo'] = null;
		}

		$result = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'logo':
					if($value)
					{
						$value = \lib\filepath::fix($value);
					}
					else
					{
						$value = \dash\app::static_logo_url();
					}

					$result[$key] = $value;
					break;

				case 'country':
					if($value)
					{
						$result['country_detail'] = [];
						$result['country_detail']['name'] = \dash\utility\location\countres::get_localname($value);
					}
					$result[$key] = $value;
					break;

				case 'province':
					if($value)
					{
						$result['province_detail'] = [];
						$result['province_detail']['name'] = \dash\utility\location\provinces::get_localname($value);
					}
					$result[$key] = $value;
					break;

				case 'city':
					if($value)
					{
						$result['city_detail'] = [];
						$result['city_detail']['name'] = \dash\utility\location\cites::get_localname($value);
					}
					$result[$key] = $value;
					break;

				case 'currency':
					if($value)
					{
						$result['currency_detail'] = \lib\currency::detail($value);
					}
					$result[$key] = $value;
					break;

				case 'length_unit':
					if($value)
					{
						$result['length_detail'] = \lib\units::detail($value, 'length');
					}
					$result[$key] = $value;
					break;

				case 'mass_unit':
					if($value)
					{
						$result['mass_detail'] = \lib\units::detail($value, 'mass');
					}
					$result[$key] = $value;
					break;


				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	public static function loaded()
	{
		if(self::id())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * get id of store
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function id()
	{
		self::init();

		if(isset(self::$store['id']))
		{
			return intval(self::$store['id']);
		}
		return null;
	}


	public static function code()
	{
		return \dash\store_coding::encode();
	}



	/**
	 * get title of store
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function title()
	{
		return self::detail('title');
	}


	public static function currency($_need = 'name')
	{
		$result = self::detail('currency');
		if($result)
		{
			$currency_detail = \lib\currency::detail($result);
		}

		if($_need)
		{
			if(isset($currency_detail[$_need]))
			{
				return $currency_detail[$_need];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return $result;
		}

	}


	public static function url()
	{
		$store_domain = null;

		$store_detail = self::detail();

		if(isset($store_detail['store_data']['domain'][0]['domain']) && $store_detail['store_data']['domain'][0]['domain'])
		{
			$store_domain = $store_detail['store_data']['domain'][0]['domain'];
			$lang = null;
			if(\dash\language::current() !== \dash\language::primary())
			{
				$lang = '/'. \dash\language::current();
			}
			$store_domain = \dash\url::protocol(). '://'. $store_domain .$lang;
		}
		else
		{
			if(\dash\engine\store::inCustomerDomain())
			{
				$store_domain = \dash\url::kingdom();
			}
			else
			{
				$store_domain = \dash\url::set_subdomain(\lib\store::detail('subdomain'));
			}

		}

		return $store_domain;
	}


	public static function logo()
	{
		return self::detail('logo');

	}


	public static function payment_detail()
	{
		$detail = \lib\app\setting\get::bank_payment_setting();
		return $detail;
	}


	/**
	 * get store detail
	 */
	public static function detail($_name = null)
	{
		self::init();

		if($_name)
		{
			if(array_key_exists($_name, self::$store))
			{
				return self::$store[$_name];
			}
			elseif(isset(self::$store['store_data']) && is_array(self::$store['store_data']) && array_key_exists($_name, self::$store['store_data']))
			{
				return self::$store['store_data'][$_name];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return self::$store;
		}
	}



	public static function plan()
	{
		return 'trial';
		return self::detail('plan');
	}



	public static function setting($_key = null)
	{
		$setting = self::detail('setting');
		if(is_string($setting))
		{
			$setting = json_decode($setting, true);
		}

		if(!is_array($setting))
		{
			$setting = [];
		}

		if($_key)
		{
			if(array_key_exists($_key, $setting))
			{
				return $setting[$_key];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return $setting;
		}
	}
}
?>