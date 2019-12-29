<?php
namespace lib\app\cache;

/**
 * get cache
 */
class get
{
	public static function admin_dashboard()
	{
		$result                   = [];
		$result['month_detail']   = \dash\date::month_precent();
		$result['product_count']  = self::product_count();
		$result['customer_count'] = self::customer_count();
		$result['staff_count']    = self::staff_count();
		$result['supplier_count'] = 0;
		$result['chart']          = self::sale_time_chart();

		return $result;
	}


	public static function product_count()
	{
		$detail = \lib\app\cache\file::get(__FUNCTION__);
		if(!$detail)
		{
			$product_count = \lib\db\products\get::count_all();
			\lib\app\cache\file::set(__FUNCTION__, $product_count);
			return intval($product_count);
		}

		return intval($detail);
	}


	public static function customer_count()
	{
		$detail = \lib\app\cache\file::get(__FUNCTION__);
		if(!$detail)
		{
			$customer_count = \dash\db\users::count_ok_users();
			\lib\app\cache\file::set(__FUNCTION__, $customer_count);
			return intval($customer_count);
		}

		return intval($detail);
	}


	public static function staff_count()
	{
		$detail = \lib\app\cache\file::get(__FUNCTION__);
		if(!$detail)
		{
			$staff_count = \dash\db\users::count_users_have_permission();
			\lib\app\cache\file::set(__FUNCTION__, $staff_count);
			return intval($staff_count);
		}

		return intval($detail);
	}



	public static function sale_time_chart()
	{
		$detail = \lib\app\cache\file::get(__FUNCTION__);
		if(!$detail)
		{
			$sale_time_chart = \lib\db\factors\chart::time_chart('sale');
			$temp = [];
			if(is_array($sale_time_chart))
			{
				foreach ($sale_time_chart as $key => $value)
				{
					$count = intval($value['count']);
					$sum   = \lib\number::down($value['sum']);
					$sum   = \lib\price::down($sum);

					$temp[] = ['key' => \dash\utility\human::fitNumber($value['key']), 'count' => intval($count), 'sum' => intval($sum)];
				}
			}
			$hi_chart               = [];
			$hi_chart['categories'] = json_encode(array_column($temp, 'key'), JSON_UNESCAPED_UNICODE);
			$hi_chart['count']      = json_encode(array_column($temp, 'count'), JSON_UNESCAPED_UNICODE);
			$hi_chart['sum']        = json_encode(array_column($temp, 'sum'), JSON_UNESCAPED_UNICODE);


			\lib\app\cache\file::set(__FUNCTION__, $hi_chart);
			return $hi_chart;
		}
		return $detail;
	}
}
?>