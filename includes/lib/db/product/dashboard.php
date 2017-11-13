<?php
namespace lib\db\product;

trait dashboard
{

	public static function product_count($_store_id)
	{
		if(!is_numeric($_store_id))
		{
			return false;
		}

		$query = "SELECT COUNT(*) AS `count` FROM products WHERE products.store_id = $_store_id ";
		return \lib\db::get($query, 'count', true);
	}


	public static function product_with_barcode($_store_id)
	{
		if(!is_numeric($_store_id))
		{
			return false;
		}

		$query = "SELECT COUNT(*) AS `count` FROM products WHERE products.store_id = $_store_id AND products.barcode IS NOT NULL ";
		return \lib\db::get($query, 'count', true);
	}


	public static function product_with_barcode2($_store_id)
	{
		if(!is_numeric($_store_id))
		{
			return false;
		}

		$query = "SELECT COUNT(*) AS `count` FROM products WHERE products.store_id = $_store_id AND products.barcode2 IS NOT NULL ";
		return \lib\db::get($query, 'count', true);
	}


	public static function max_min_avg_field($_store_id, $_type, $_field)
	{
		if(!is_numeric($_store_id))
		{
			return false;
		}

		$query = "SELECT $_type(products.$_field) AS `val` FROM products WHERE products.store_id = $_store_id ";
		return \lib\db::get($query, 'val', true);
	}
}
?>
