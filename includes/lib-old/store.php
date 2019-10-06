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

		$store_detail = \lib\db\stores::get(['slug' => self::store_slug(), 'limit' => 1]);

		if(is_array($store_detail))
		{
			if(array_key_exists('logo', $store_detail) && !$store_detail['logo'])
			{
				$store_detail['logo'] = \dash\app::static_logo_url();
			}

			if(isset($store_detail['meta']))
			{
				if(is_string($store_detail['meta']) && substr($store_detail['meta'], 0, 1) === '{')
				{
					$store_detail['meta'] = json_decode($store_detail['meta'], true);
				}
			}

			self::$store = $store_detail;
			\dash\session::set('store_detail_'. self::store_slug(), $store_detail);
		}
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
	 * get name of store
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function name()
	{
		self::init();

		if(isset(self::$store['name']))
		{
			return self::$store['name'];
		}
		return null;
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
			return null;
		}
		else
		{
			return self::$store;
		}
	}


	/**
	 * check the user is creator of this store or no
	 *
	 * @return     boolean  True if creator, False otherwise.
	 */
	public static function is_creator()
	{
		if(
			\dash\user::id() &&
			\lib\store::id() &&
			\lib\store::detail('creator') &&
			intval(\dash\user::id()) === intval(\lib\store::detail('creator'))
		  )
		{
			return true;
		}
		return false;
	}


	public static function plan()
	{
		return self::detail('plan');
	}


	public static function creator()
	{
		return intval(self::detail('creator'));
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