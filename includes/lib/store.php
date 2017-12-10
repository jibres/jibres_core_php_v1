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
		\lib\session::set('store_detail_'. SubDomain, null);
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

		if(\lib\session::get('store_detail_'. SubDomain))
		{
			self::$store = \lib\session::get('store_detail_'. SubDomain);
			return;
		}

		$store_detail = \lib\db\stores::get(['slug' => SubDomain, 'limit' => 1]);

		if(is_array($store_detail))
		{
			if(array_key_exists('logo', $store_detail) && !$store_detail['logo'])
			{
				$store_detail['logo'] = \lib\app::static_logo_url();
			}

			self::$store = $store_detail;
			\lib\session::set('store_detail_'. SubDomain, $store_detail);
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
			\lib\user::id() &&
			\lib\store::id() &&
			\lib\store::detail('creator') &&
			intval(\lib\user::id()) === intval(\lib\store::detail('creator'))
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