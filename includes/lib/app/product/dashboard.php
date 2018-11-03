<?php
namespace lib\app\product;

class dashboard
{
	private static $life_time = 60 * 10;

	public static function clean_cache($_type = null)
	{
		switch ($_type)
		{
			case 'var':
				self::product_count(true);
				self::product_with_barcode(true);
				self::product_with_barcode2(true);
				self::max_min_avg_field('min', 'buyprice', true);
				self::max_min_avg_field('max', 'buyprice', true);
				self::max_min_avg_field('avg', 'buyprice', true);
				self::max_min_avg_field('min', 'price', true);
				self::max_min_avg_field('max', 'price', true);
				self::max_min_avg_field('avg', 'price', true);
				self::max_min_avg_field('min', 'discount', true);
				self::max_min_avg_field('max', 'discount', true);
				self::max_min_avg_field('avg', 'discount', true);
				break;

			case 'chart':
				self::product_price_variation(true);
				self::product_price_group_by_unit(true);
				self::product_price_group_by_cat(true);
				break;

			default:
				self::detail(true);
				break;
		}
	}


	public static function detail($_clean_cache = false)
	{
		$store_id = \lib\store::id();
		if(!$store_id)
		{
			return false;
		}

		$result                                = [];
		$result['product_count']               = self::product_count($_clean_cache);
		$result['product_with_barcode']        = self::product_with_barcode($_clean_cache);
		$result['product_whit_barcode2']       = self::product_with_barcode2($_clean_cache);
		$result['product_buyprice_min']        = self::max_min_avg_field('min', 'buyprice', $_clean_cache);
		$result['product_buyprice_max']        = self::max_min_avg_field('max', 'buyprice', $_clean_cache);
		$result['product_buyprice_avg']        = self::max_min_avg_field('avg', 'buyprice', $_clean_cache);
		$result['product_price_min']           = self::max_min_avg_field('min', 'price', $_clean_cache);
		$result['product_price_max']           = self::max_min_avg_field('max', 'price', $_clean_cache);
		$result['product_price_avg']           = self::max_min_avg_field('avg', 'price', $_clean_cache);
		$result['product_discount_min']        = self::max_min_avg_field('min', 'discount', $_clean_cache);
		$result['product_discount_max']        = self::max_min_avg_field('max', 'discount', $_clean_cache);
		$result['product_discount_avg']        = self::max_min_avg_field('avg', 'discount', $_clean_cache);
		$result['product_price_variation']     = self::product_price_variation($_clean_cache);
		$result['product_price_group_by_unit'] = self::product_price_group_by_unit($_clean_cache);
		$result['product_price_group_by_cat']  = self::product_price_group_by_cat($_clean_cache);

		return $result;
	}


	public static function product_count($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\dash\session::clean('dashboard_product_count_'. \lib\store::id(), 'jibres_store');
			return null;
		}

		$count = \dash\session::get('dashboard_product_count_'. \lib\store::id(), 'jibres_store');
		if($count === null)
		{
			$count = \lib\db\products::product_count(\lib\store::id());
			$count = intval($count);
			\dash\session::set('dashboard_product_count_'. \lib\store::id(), $count, 'jibres_store',  self::$life_time);
		}
		return $count;
	}


	public static function product_with_barcode($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\dash\session::clean('dashboard_product_with_barcode_'. \lib\store::id(), 'jibres_store');
			return null;
		}

		$count = \dash\session::get('dashboard_product_with_barcode_'. \lib\store::id(), 'jibres_store');
		if($count === null)
		{
			$count = \lib\db\products::product_with_barcode(\lib\store::id());
			$count = intval($count);
			\dash\session::set('dashboard_product_with_barcode_'. \lib\store::id(), $count, 'jibres_store',  self::$life_time);
		}
		return $count;
	}


	public static function product_with_barcode2($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\dash\session::clean('dashboard_product_with_barcode2_'. \lib\store::id(), 'jibres_store');
			return null;
		}

		$count = \dash\session::get('dashboard_product_with_barcode2_'. \lib\store::id(), 'jibres_store');
		if($count === null)
		{
			$count = \lib\db\products::product_with_barcode2(\lib\store::id());
			$count = intval($count);
			\dash\session::set('dashboard_product_with_barcode2_'. \lib\store::id(), $count, 'jibres_store',  self::$life_time);
		}
		return $count;
	}


	public static function max_min_avg_field($_type, $_field, $_clean_cache = false)
	{
		$key = "dashboard_product_". $_type. "_". $_field. "_". \lib\store::id();
		if($_clean_cache)
		{
			\dash\session::clean($key, 'jibres_store');
			return null;
		}

		$value = \dash\session::get($key, 'jibres_store');
		if($value === null)
		{
			$value = \lib\db\products::max_min_avg_field(\lib\store::id(), $_type, $_field);
			$value = floatval($value);
			\dash\session::set($key, $value,  'jibres_store', self::$life_time);
		}
		return $value;
	}


	public static function product_price_variation($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\dash\session::clean('dashboard_price_variation_'. \lib\store::id(), 'jibres_store');
			return null;
		}

		$chart = \dash\session::get('dashboard_price_variation_'. \lib\store::id(), 'jibres_store');
		if($chart === null)
		{
			$chart        = \lib\db\products::price_variation(\lib\store::id());
			$temp         = [];
			$chartGroup10 = [];
			$chartTotal   = 0;

			foreach ($chart as $key => $value)
			{
				$myGroup = floor(floatval($key) / 10000);
				if(!isset($chartGroup10[$myGroup]))
				{
					$chartGroup10[$myGroup] = +$value;
				}
				else
				{
					$chartGroup10[$myGroup] += $value;
				}
			}
			$chartTotal = array_sum($chartGroup10);

			foreach ($chart as $key => $value)
			{

				$myGroup = floor(floatval($key) / 10000);
				if($key === '')
				{
					$key = T_('unknown');
				}
				if(isset($chartGroup10[$myGroup]) && $chartGroup10[$myGroup])
				{
					if((float) $chartTotal / (float) $chartGroup10[$myGroup] > 10)
					{
						$temp[] = ["key" => ($myGroup* 10000).'+' , "value" => $chartGroup10[$myGroup]];
						$chartGroup10[$myGroup] = null;
					}
					else
					{
						$temp[] = ["key" => $key, "value" => $value];
					}
				}
			}

			$chart = json_encode($temp, JSON_UNESCAPED_UNICODE);
			\dash\session::set('dashboard_price_variation_'. \lib\store::id(), $chart, 'jibres_store',  self::$life_time);
		}

		return $chart;
	}


	public static function product_price_group_by_unit($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\dash\session::clean('dashboard_price_group_by_unit_'. \lib\store::id(), 'jibres_store');
			return null;
		}
		$chart = \dash\session::get('dashboard_price_group_by_unit_'. \lib\store::id(), 'jibres_store');
		if($chart === null)
		{
			$chart = \lib\db\products::price_group_by_unit(\lib\store::id());
			$temp = [];
			foreach ($chart as $key => $value)
			{
				$temp[] = ["key" => $key, "value" => $value];
			}
			$chart = json_encode($temp, JSON_UNESCAPED_UNICODE);
			\dash\session::set('dashboard_price_group_by_unit_'. \lib\store::id(), $chart, 'jibres_store',  self::$life_time);
		}

		return $chart;
	}


	public static function product_price_group_by_cat($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\dash\session::clean('dashboard_price_group_by_cat_'. \lib\store::id(), 'jibres_store');
			return null;
		}

		$chart = \dash\session::get('dashboard_price_group_by_cat_'. \lib\store::id(), 'jibres_store');
		if($chart === null)
		{
			$chart = \lib\db\products::price_group_by_cat(\lib\store::id());
			$temp = [];
			foreach ($chart as $key => $value)
			{
				$temp[] = ["key" => $key, "value" => $value];
			}
			$chart = json_encode($temp, JSON_UNESCAPED_UNICODE);
			\dash\session::set('dashboard_price_group_by_cat_'. \lib\store::id(), $chart, 'jibres_store',  self::$life_time);
		}

		return $chart;
	}
}
?>