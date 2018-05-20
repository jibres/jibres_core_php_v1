<?php
namespace lib\app\store;

trait dashboard
{
	private static $life_time = 60 * 1;

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

		if(\lib\store::detail('creator'))
		{
			$result['count_store'] = self::count_store_by_creator(\lib\store::detail('creator'));
		}

		$result['customer_count']  = self::user_count('customer');
		$result['supplier_count']  = self::user_count('supplier');
		$result['staff_count']     = self::user_count('staff');
		$result['product_count']   = \lib\app\product::product_count();
		$result['sale_time_chart'] = self::sale_time_chart();

		return $result;
	}


	public static function sale_time_chart()
	{
		$sale_time_chart = \dash\session::get('dashboard_sale_time_chart_'. \lib\store::id());
		if($sale_time_chart === null)
		{
			$sale_time_chart = \lib\db\factors::time_chart(\lib\store::id(), 'sale');
			$temp = [];
			if(is_array($sale_time_chart))
			{
				foreach ($sale_time_chart as $key => $value)
				{
					$temp[] = ['key' => $key, 'value' => $value];
				}
			}
			$sale_time_chart = json_encode($temp, JSON_UNESCAPED_UNICODE);

			\dash\session::set('dashboard_sale_time_chart_'. \lib\store::id(), $sale_time_chart, null,  self::$life_time);
		}
		return $sale_time_chart;
	}


	/**
	 * Counts the number of store by creator.
	 *
	 * @param      <type>   $_creator_id  The creator identifier
	 *
	 * @return     boolean  Number of store by creator.
	 */
	public static function count_store_by_creator($_creator_id, $_clean_cache = false)
	{
		if(!$_creator_id || !is_numeric($_creator_id))
		{
			return false;
		}

		$cache_key = 'store_dashboard_count_store_by_creator'. \dash\user::id();

		if($_clean_cache)
		{
			\dash\session::set($cache_key, null);
			return null;
		}

		$count = \dash\session::get($cache_key);

		if($count === null)
		{
			$count = intval(\lib\db\stores::get_count_store_by_creator($_creator_id));
			\dash\session::set($cache_key, $count, null,  self::$life_time);
		}

		return $count;
	}


	public static function user_count($_type, $_clean_cache = false)
	{
		$cache_key = 'store_dashboard_'. $_type. '_'. \lib\store::id();

		if($_clean_cache)
		{
			\dash\session::set($cache_key, null);
			return null;
		}

		$count = \dash\session::get($cache_key);
		if($count === null)
		{
			$count = \lib\db\userstores::get_count([$_type => 1, 'store_id' => \lib\store::id()]);
			$count = intval($count);
			\dash\session::set($cache_key, $count, null,  self::$life_time);
		}
		return $count;
	}

}
?>
