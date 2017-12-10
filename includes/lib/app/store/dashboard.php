<?php
namespace lib\app\store;

trait dashboard
{
	private static $life_time = 60 * 10;

	/**
	 * dashboard detail
	 *
	 * @param      <type>         $_store_id  The store identifier
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function dashboard_detail($_store_id)
	{
		if(!$_store_id || !is_numeric($_store_id))
		{
			return false;
		}

		$result = [];

		$store_detail = \lib\db\stores::get(['id' => $_store_id, 'limit' => 1]);
		if(isset($store_detail['creator']))
		{
			$result['count_store'] = self::count_store_by_creator($store_detail['creator']);
		}

		$result['customer_count'] = self::user_count('customer');
		$result['supplier_count'] = self::user_count('supplier');
		$result['staff_count']    = self::user_count('staff');

		return $result;
	}


	/**
	 * Counts the number of store by creator.
	 *
	 * @param      <type>   $_creator_id  The creator identifier
	 *
	 * @return     boolean  Number of store by creator.
	 */
	public static function count_store_by_creator($_creator_id)
	{
		if(!$_creator_id || !is_numeric($_creator_id))
		{
			return false;
		}

		return intval(\lib\db\stores::get_count_store_by_creator($_creator_id));
	}


	public static function user_count($_type, $_clean_cache = false)
	{
		$cache_key = 'store_dashboard_'. $_type. '_'. \lib\store::id();

		if($_clean_cache)
		{
			\lib\session::set($cache_key, null);
			return null;
		}

		$count = \lib\session::get($cache_key);
		if($count === null)
		{
			$count = \lib\db\userstores::get_count(['type' => $_type, 'store_id' => \lib\store::id()]);
			$count = intval($count);
			\lib\session::set($cache_key, $count, null,  self::$life_time);
		}
		return $count;
	}

}
?>
