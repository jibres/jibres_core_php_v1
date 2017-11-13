<?php
namespace lib\app\product;

trait dashboard
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
				self::dashboard(true);
				break;
		}
	}


	public static function dashboard($_clean_cache = false)
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
			\lib\session::set('dashboard_product_count', null);
			return null;
		}

		$count = \lib\session::get('dashboard_product_count');
		if($count === null)
		{
			$count = \lib\db\products::product_count(\lib\store::id());
			$count = intval($count);
			\lib\session::set('dashboard_product_count', $count, null,  self::$life_time);
		}
		return $count;
	}


	public static function product_with_barcode($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\lib\session::set('dashboard_product_with_barcode', null);
			return null;
		}

		$count = \lib\session::get('dashboard_product_with_barcode');
		if($count === null)
		{
			$count = \lib\db\products::product_with_barcode(\lib\store::id());
			$count = intval($count);
			\lib\session::set('dashboard_product_with_barcode', $count, null,  self::$life_time);
		}
		return $count;
	}


	public static function product_with_barcode2($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\lib\session::set('dashboard_product_with_barcode2', null);
			return null;
		}

		$count = \lib\session::get('dashboard_product_with_barcode2');
		if($count === null)
		{
			$count = \lib\db\products::product_with_barcode2(\lib\store::id());
			$count = intval($count);
			\lib\session::set('dashboard_product_with_barcode2', $count, null,  self::$life_time);
		}
		return $count;
	}


	public static function max_min_avg_field($_type, $_field, $_clean_cache = false)
	{
		$key = "dashboard_product_". $_type. "_". $_field;
		if($_clean_cache)
		{
			\lib\session::set($key, null);
			return null;
		}

		$value = \lib\session::get($key);
		if($value === null)
		{
			$value = \lib\db\products::max_min_avg_field(\lib\store::id(), $_type, $_field);
			$value = floatval($value);
			\lib\session::set($key, $value,  null, self::$life_time);
		}
		return $value;
	}


	public static function product_price_variation($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\lib\session::set('dashboard_price_variation', null);
			return null;
		}

		$chart = \lib\session::get('dashboard_price_variation');
		if($chart === null)
		{
			$chart = \lib\db\products::price_variation(\lib\store::id());
			$temp = [];
			foreach ($chart as $key => $value)
			{
				$temp[] = ["key" => $key, "value" => $value];
			}
			$chart = json_encode($temp, JSON_UNESCAPED_UNICODE);
			\lib\session::set('dashboard_price_variation', $chart, null,  self::$life_time);
		}

		return $chart;
	}


	public static function product_price_group_by_unit($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\lib\session::set('dashboard_price_group_by_unit', null);
			return null;
		}
		$chart = \lib\session::get('dashboard_price_group_by_unit');
		if($chart === null)
		{
			$chart = \lib\db\products::price_group_by_unit(\lib\store::id());
			$temp = [];
			foreach ($chart as $key => $value)
			{
				$temp[] = ["key" => $key, "value" => $value];
			}
			$chart = json_encode($temp, JSON_UNESCAPED_UNICODE);
			\lib\session::set('dashboard_price_group_by_unit', $chart, null,  self::$life_time);
		}

		return $chart;
	}


	public static function product_price_group_by_cat($_clean_cache = false)
	{
		if($_clean_cache)
		{
			\lib\session::set('dashboard_price_group_by_cat', null);
			return null;
		}

		$chart = \lib\session::get('dashboard_price_group_by_cat');
		if($chart === null)
		{
			$chart = \lib\db\products::price_group_by_cat(\lib\store::id());
			$temp = [];
			foreach ($chart as $key => $value)
			{
				$temp[] = ["key" => $key, "value" => $value];
			}
			$chart = json_encode($temp, JSON_UNESCAPED_UNICODE);
			\lib\session::set('dashboard_price_group_by_cat', $chart, null,  self::$life_time);
		}

		return $chart;
	}
}
?>