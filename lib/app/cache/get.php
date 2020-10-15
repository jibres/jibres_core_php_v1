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
		$result['month_detail']   = self::month_precent();
		$result['product_count']  = self::product_count();
		$result['customer_count'] = self::customer_count();
		$result['staff_count']    = self::staff_count();
		$result['supplier_count'] = 0;
		$result['chart']          = self::sale_time_chart();

		return $result;
	}


	 public static function month_precent($_type = null)
    {
    	$lang = \dash\language::current();

    	if($lang === 'fa')
    	{
			$d = intval(\dash\utility\jdate::date("d", false, false));
			$m = intval(\dash\utility\jdate::date("m", false, false));
			$t = intval(\dash\utility\jdate::date("t", false, false));
    	}
    	else
    	{
			$d = intval(date("d"));
			$m = intval(date("m"));
			$t = intval(date("t"));
    	}

        $left   = round(($d * 100) / $t);
        $remain = round((($t - $d) * 100) / $t);

        $return = null;
        switch ($_type)
        {
            case 'left':
                $return = $left;
                break;
            case 'remain':
                $return = $remain;
                break;
            default:
                $return =
                [
					'left'   => $left,
					'remain' => $remain,
					'count'  => $t,
                ];
                break;
        }
        return $return;
    }



	public static function product_count()
	{
		$product_count = \lib\db\products\get::count_all_for_dashboard();
		return intval($product_count);

		// $detail = \lib\app\cache\file::get(__FUNCTION__);
		// if(!$detail)
		// {
		// 	$product_count = \lib\db\products\get::count_all();
		// 	\lib\app\cache\file::set(__FUNCTION__, $product_count);
		// 	return intval($product_count);
		// }

		// return intval($detail);
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
					$count = floatval($value['count']);
					$sum   = \lib\number::down($value['sum']);
					$sum   = \lib\price::down($sum);

					$temp[] = ['key' => \dash\fit::number($value['key']), 'count' => $count, 'sum' => $sum];
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