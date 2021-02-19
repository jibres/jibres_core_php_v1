<?php
namespace lib;

/**
 * Class for store.
 */
class store
{
	/**
	 * Load store detail
	 *
	 * @var        array
	 */
	private static $store      = [];


	/**
	 * Set master config for load store
	 * use in content_business and content_n
	 *
	 */
	public static function check_master_business_config()
	{
		$nosale = \lib\store::detail('nosale');
		if($nosale)
		{
			\dash\data::nosale(true);
		}
	}



	// clean session and init again store detail
	public static function refresh()
	{
		$store_id = self::id();
		if($store_id)
		{
			self::reset_cache();
			self::$store = [];
			self::init();
		}
	}



	public static function reset_cache($_id = null, $_subdomain = null)
	{
		$subdomain = null;

		if(!$_id)
		{
			$id        = self::id();
			$subdomain = self::detail('subdomain');
		}
		else
		{
			$id = $_id;
		}

		if(!$subdomain && $_subdomain)
		{
			$subdomain = $_subdomain;
		}

		if($subdomain)
		{
			$addr = \dash\engine\store::subdomain_addr(). $subdomain. \dash\engine\store::$ext;
			if(is_file($addr))
			{
				\dash\file::delete($addr);
			}
		}

		if(!$id || !is_numeric($id))
		{
			return false;
		}

		$addr = \dash\engine\store::detail_addr(). $id. \dash\engine\store::$ext;
		if(is_file($addr))
		{
			\dash\file::delete($addr);
		}

		$addr = \dash\engine\store::cache_addr(). $id. \dash\engine\store::$ext;
		if(is_file($addr))
		{
			\dash\file::delete($addr);
		}


		$addr = \dash\engine\store::setting_addr(). $id. \dash\engine\store::$ext;
		if(is_file($addr))
		{
			\dash\file::delete($addr);
		}

		\lib\app\business_domain\business::reset_list($id);

		$domain_list = \lib\db\business_domain\get::by_store_id($id);
		if($domain_list && is_array($domain_list))
		{
			foreach ($domain_list as $key => $value)
			{
				if(isset($value['domain']))
				{
					$addr = \dash\engine\store::customer_domain_addr(). $value['domain']. \dash\engine\store::$ext;
					if(is_file($addr))
					{
						\dash\file::delete($addr);
					}
				}
			}
		}

		if(!$_id)
		{
			self::$store = [];
		}

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


		$store_detail_file = \dash\engine\store::store_detail();

 		// no file founded an no record existe in jibres database
 		if(!$store_detail_file || !isset($store_detail_file['store']))
 		{
 			return false;
 		}

 		$store_detail = $store_detail_file['store'];

		self::$store = $store_detail;

		self::$store['store_data'] = self::file_store_data(self::$store);
	}


	/**
	 * Check user is inserted to current database user or no
	 * where supervisor check the store the supervisor not in_stroe and can not add or edit any thing
	 */
	public static function in_store()
	{
		if(\dash\user::detail('user_in_store'))
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
		$addr = \dash\engine\store::setting_addr(). self::id(). \dash\engine\store::$ext;

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


	public static function file_store_data($_store_detail)
	{
		if(!isset($_store_detail['id']))
		{
			return false;
		}

		$addr = \dash\engine\store::setting_addr(). $_store_detail['id']. \dash\engine\store::$ext;

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
	public static function store_detail_setting_record($_store_id)
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
				$result[$value['key']] = $value['value'];
			}
		}

		$result['domain'] = \lib\app\business_domain\business::domain_list($_store_id);

		if(array_key_exists('logo', $result) && !$result['logo'])
		{
			$result['logo'] = \dash\app::static_logo_url();
		}


		$addr = \dash\engine\store::setting_addr();
		if(!is_dir($addr))
		{
			\dash\file::makeDir($addr, null, true);
		}
		$addr .= $_store_id. \dash\engine\store::$ext;

		$result['update_time'] = time();
		\dash\file::write($addr, json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

		$result = self::ready_setting($result);

		return $result;
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

	public static function code_raw()
	{
		return \dash\store_coding::encode_raw();
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


	public static function desc()
	{
		return self::detail('desc');
	}


	public static function social($_need = null, $_only_get_username = false)
	{
		$detail = self::detail();
		if(isset($detail['store_data']))
		{
			$detail = $detail['store_data'];
		}

		if(!is_array($detail))
		{
			$detail = [];
		}

		$social = [];


		foreach ($detail as $key => $value)
		{
			switch ($key)
			{
				case 'instagram': 	$social['instagram'] = ['user' => $value, 'title' => T_("Instagram"), 'link' => 'https://instagram.com/'. $value];  break;
				case 'telegram': 	$social['telegram']  = ['user' => $value, 'title' => T_("Telegram"), 'link' => 'https://t.me/'. $value];			break;
				case 'youtube':		$social['youtube']   = ['user' => $value, 'title' => T_("Youtube"), 'link' => 'https://youtube.com/'. $value];	break;
				case 'twitter':		$social['twitter']   = ['user' => $value, 'title' => T_("Twitter"), 'link' => 'https://twitter.com/'. $value];	break;
				case 'linkedin':	$social['linkedin']  = ['user' => $value, 'title' => T_("Linkedin"), 'link' => 'https://linkedin.com/'. $value];	break;
				case 'github':		$social['github']    = ['user' => $value, 'title' => T_("Github"), 'link' => 'https://github.com/'. $value];		break;
				case 'facebook':	$social['facebook']  = ['user' => $value, 'title' => T_("Facebook"), 'link' => 'https://facebook.com/'. $value];	break;
				case 'email':		$social['email']     = ['user' => $value, 'title' => T_("Email"), 'link' => 'mailto:'. $value];					break;
				case 'aparat':		$social['aparat']    = ['user' => $value, 'title' => T_("Aparat"), 'link' => 'https://aparat.com/'. $value];		break;
				case 'eitaa':		$social['eitaa']     = ['user' => $value, 'title' => T_("Eitaa"), 'link' => 'https://eitaa.com/'. $value];		break;
				default:
					# code...
					break;
			}

		}

		if($_need)
		{
			if(isset($social[$_need]))
			{
				if($_only_get_username)
				{
					if(isset($social[$_need]['user']))
					{
						return $social[$_need]['user'];
					}
					else
					{
						return null;
					}
				}
				else
				{
					return $social[$_need];
				}
			}
			else
			{
				return null;
			}
		}
		else
		{
			return $social;
		}
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

	public static function admin_url()
	{
		$tld = \dash\url::tld() === 'ir' ? 'ir' : 'com';

		if(\dash\language::current() === 'fa')
		{
			$tld = 'ir';
		}
		else
		{
			$tld = 'com';
		}

		if(\dash\url::isLocal())
		{
			$tld = 'local';
		}

		$lang = null;
		if(\dash\url::lang())
		{
			$lang = '/'. \dash\url::lang();
		}
		return \dash\url::protocol(). '://jibres.'.$tld. $lang. '/'. self::code();
	}


	public static function master_domain($_full = false)
	{
		$master_domain = null;

		$store_detail = self::detail();

		if(isset($store_detail['store_data']['domain']) && is_array($store_detail['store_data']['domain']))
		{
			foreach ($store_detail['store_data']['domain'] as $key => $value)
			{
				if(
					isset($value['domain']) &&
					$value['domain'] &&
					isset($value['master']) &&
					$value['master'] &&
					(
						(
							isset($value['status']) &&
							$value['status'] === 'ok'
						)
						||
						(
							isset($value['subdomain']) &&
							$value['subdomain']
						)
					)
				  )
				{

					$master_domain = $value['domain'];
					// $lang = null;
					// if(\dash\language::current() !== \dash\language::primary())
					// {
					// 	$lang = '/'. \dash\language::current();
					// }
					$master_domain = \dash\url::protocol(). '://'. $master_domain; // .$lang;
					if($_full && \dash\url::path())
					{
						$master_domain .= \dash\url::path();
					}
				}
			}

		}

		return $master_domain;
	}


	/**
	 * Retrun the store url
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function url()
	{
		$store_domain = self::master_domain();

		if($store_domain)
		{
			// nothing
		}
		else
		{
			if(\dash\engine\store::inCustomerDomain())
			{
				$store_domain = \dash\url::kingdom();
			}
			else
			{
				$store_domain = \dash\url::business_url(\lib\store::detail('subdomain'));
			}

		}

		return $store_domain;
	}


	public static function logo()
	{
		return self::detail('logo');
	}


	public static function enterprise()
	{
		return self::detail('enterprise');
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


	public static function branding()
	{
		$branding = self::detail('branding');

		if(!$branding)
		{
			return true;
		}

		$branding_time = strtotime($branding);
		if($branding_time === false)
		{
			return true;
		}
		// have time
		if($branding_time >= time())
		{
			return false;
		}

		return true;
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



	public static function my_fuel()
	{
		if(self::detail('fuel'))
		{
			$fuel      = \dash\engine\fuel::get(self::detail('fuel'));
			return $fuel;
		}

		return null;
	}

	public static function my_db_name()
	{
		if(self::id())
		{
			$db_name           = \dash\engine\store::make_database_name(self::id());
			return $db_name;
		}

		return null;
	}
}
?>