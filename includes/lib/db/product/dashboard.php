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
		return \dash\db::get($query, 'count', true);
	}


	public static function product_with_barcode($_store_id)
	{
		if(!is_numeric($_store_id))
		{
			return false;
		}

		$query = "SELECT COUNT(*) AS `count` FROM products WHERE products.store_id = $_store_id AND products.barcode IS NOT NULL ";
		return \dash\db::get($query, 'count', true);
	}


	public static function product_with_barcode2($_store_id)
	{
		if(!is_numeric($_store_id))
		{
			return false;
		}

		$query = "SELECT COUNT(*) AS `count` FROM products WHERE products.store_id = $_store_id AND products.barcode2 IS NOT NULL ";
		return \dash\db::get($query, 'count', true);
	}


	public static function max_min_avg_field($_store_id, $_type, $_field)
	{
		if(!is_numeric($_store_id))
		{
			return false;
		}

		$query = "SELECT $_type(products.$_field) AS `val` FROM products WHERE products.store_id = $_store_id ";
		return \dash\db::get($query, 'val', true);
	}


	public static function price_variation($_store_id)
	{
		if(!is_numeric($_store_id))
		{
			return false;
		}

		$query =
		"
			SELECT
				ROUND(products.price, -3) AS `price_key`,
				COUNT(*) AS `value`
			FROM
				products
			WHERE
				products.store_id = $_store_id
			GROUP BY price_key
			";
		return \dash\db::get($query, ['price_key', 'value']);
	}


	public static function price_group_by_unit($_store_id)
	{
		if(!is_numeric($_store_id))
		{
			return false;
		}

		$query =
		"
			SELECT
				products.unit AS `unit`,
				COUNT(*) AS `value`
			FROM
				products
			WHERE
				products.store_id = $_store_id
			GROUP BY unit

			";
		return \dash\db::get($query, ['unit', 'value']);
	}


	public static function price_group_by_cat($_store_id)
	{
		if(!is_numeric($_store_id))
		{
			return false;
		}

		$query =
		"
			SELECT
				products.cat AS `cat`,
				COUNT(*) AS `value`
			FROM
				products
			WHERE
				products.store_id = $_store_id
			GROUP BY cat
			ORDER BY value DESC
			";
		return \dash\db::get($query, ['cat', 'value']);
	}
}
?>
