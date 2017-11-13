<?php
namespace lib\app\product;

trait dashboard
{
	private static $life_time = 60 * 1;


	public static function dashboard()
	{
		$store_id = \lib\store::id();
		if(!$store_id)
		{
			return false;
		}

		$result                          = [];
		$result['product_count']         = self::product_count();
		$result['product_with_barcode']  = self::product_with_barcode();
		$result['product_whit_barcode2'] = self::product_with_barcode2();
		$result['product_buyprice_min']  = self::max_min_avg_field('min', 'buyprice');
		$result['product_buyprice_max']  = self::max_min_avg_field('max', 'buyprice');
		$result['product_buyprice_avg']  = self::max_min_avg_field('avg', 'buyprice');
		$result['product_price_min']     = self::max_min_avg_field('min', 'price');
		$result['product_price_max']     = self::max_min_avg_field('max', 'price');
		$result['product_price_avg']     = self::max_min_avg_field('avg', 'price');
		$result['product_discount_min']  = self::max_min_avg_field('min', 'discount');
		$result['product_discount_max']  = self::max_min_avg_field('max', 'discount');
		$result['product_discount_avg']  = self::max_min_avg_field('avg', 'discount');
		return $result;
	}


	public static function product_count()
	{
		$count = \lib\session::get('dashboard_product_count');
		if($count === null)
		{
			$count = \lib\db\products::product_count(\lib\store::id());
			$count = intval($count);
			\lib\session::set('dashboard_product_count', $count, null,  self::$life_time);
		}
		return $count;
	}


	public static function product_with_barcode()
	{
		$count = \lib\session::get('dashboard_product_with_barcode');
		if($count === null)
		{
			$count = \lib\db\products::product_with_barcode(\lib\store::id());
			$count = intval($count);
			\lib\session::set('dashboard_product_with_barcode', $count, null,  self::$life_time);
		}
		return $count;
	}


	public static function product_with_barcode2()
	{
		$count = \lib\session::get('dashboard_product_with_barcode2');
		if($count === null)
		{
			$count = \lib\db\products::product_with_barcode2(\lib\store::id());
			$count = intval($count);
			\lib\session::set('dashboard_product_with_barcode2', $count, null,  self::$life_time);
		}
		return $count;
	}


	public static function max_min_avg_field($_type, $_field)
	{
		$key = "dashboard_product_". $_type. "_". $_field;
		$value = \lib\session::get($key);
		if($value === null)
		{
			$type = null;
			switch ($_type)
			{
				case 'min':
				case 'max':
				case 'avg':
					$type = mb_strtoupper($_type);
					break;

				default:
					return false;
					break;
			}

			$value = \lib\db\products::max_min_avg_field(\lib\store::id(), $type, $_field);
			$value = floatval($value);
			\lib\session::set($key, $value,  null, self::$life_time);
		}
		return $value;
	}


}
?>