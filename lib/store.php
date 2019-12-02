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
		\dash\session::set('store_detail_'. self::store_slug(), null);
		self::$store = [];
	}


	// set slug of store in api and load it
	public static function set_store_slug($_slug)
	{
		self::$store_slug = $_slug;
	}

	// in api no user can set subdomain
	public static function store_slug()
	{
		if(\dash\url::subdomain())
		{
			return \dash\url::subdomain();
		}
		elseif(self::$store_slug)
		{
			return self::$store_slug;
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


		if(\dash\session::get('store_detail_'. self::store_slug()))
		{
			self::$store = \dash\session::get('store_detail_'. self::store_slug());
			return;
		}

		self::clean_session(self::store_slug());

 		$store_detail_file = \dash\engine\store::init_subdomain(self::store_slug());

 		// no file founded an no record existe in jibres database
 		if(!$store_detail_file)
 		{
 			return false;
 		}

		$store_detail_setting_record = \lib\app\setting\tools::get_cat('store_setting');

		if(is_array($store_detail_setting_record))
		{
			$store_detail_setting_record = array_column($store_detail_setting_record, 'value', 'key');
		}

		if(!isset($store_detail_file['store']))
		{
			return false;
		}

		$store_detail = $store_detail_file['store'];

		if(is_array($store_detail_setting_record))
		{
			$store_detail['store_data'] = $store_detail_setting_record;
		}

		if(isset($store_detail['store_data']) && is_array($store_detail['store_data']))
		{

			if(array_key_exists('logo', $store_detail['store_data']) && !$store_detail['store_data']['logo'])
			{
				$store_detail['store_data']['logo'] = \dash\app::static_logo_url();
			}
		}

		self::$store = $store_detail;

		\dash\session::set('store_detail_'. self::store_slug(), $store_detail);
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



	/**
	 * get title of store
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function title()
	{
		return self::detail('title');
	}


	public static function logo()
	{
		return self::detail('logo');

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