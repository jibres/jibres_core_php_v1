<?php
namespace lib;

/**
 * Class for store.
 */
class store
{

	private static $store = [];


	/**
	 * initial store detail
	 */
	public static function init()
	{
		if(!empty(self::$store))
		{
			return;
		}

		if(\lib\session::get('store_detail'))
		{
			self::$store = \lib\session::get('store_detail');
			return;
		}

		$store_detail = \lib\db\stores::get(['slug' => SubDomain, 'limit' => 1]);

		if(is_array($store_detail))
		{
			self::$store = $store_detail;
			\lib\session::set('store_detail', $store_detail);
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
}
?>