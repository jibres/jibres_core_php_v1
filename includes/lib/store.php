<?php
namespace lib;

/**
 * Class for store.
 */
class store
{

	private static $store = [];


	/**
	 * clean chach to load detail again
	 * user in edit store
	 */
	public static function clean()
	{
		\dash\session::set('store_detail_'. \dash\url::subdomain(), null);
		self::$store = [];
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

		if(\dash\session::get('store_detail_'. \dash\url::subdomain()))
		{
			self::$store = \dash\session::get('store_detail_'. \dash\url::subdomain());
			return;
		}

		$store_detail = \lib\db\stores::get(['slug' => \dash\url::subdomain(), 'limit' => 1]);

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
			\dash\session::set('store_detail_'. \dash\url::subdomain(), $store_detail);
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
}
?>