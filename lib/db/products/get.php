<?php
namespace lib\db\products;

class get
{
	public static function count_all()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM products where products.status != 'deleted' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function next_prev($_id)
	{
		$next        = "SELECT products.id AS `id` FROM products where products.id = (SELECT MIN(products.id) FROM products where products.id > $_id) LIMIT 1 ";
		$next_result = \dash\db::get($next, 'id', true);

		$prev        = "SELECT products.id AS `id` FROM products where products.id = (SELECT MAX(products.id) FROM products where products.id < $_id) LIMIT 1 ";
		$prev_result = \dash\db::get($prev, 'id', true);

		return
		[
			'next' => $next_result,
			'prev' => $prev_result
		];
	}



	public static function barcode($_barcode)
	{
		$query =
		"
			SELECT
				`id`,
				`title`,
				`barcode`,
				`barcode2`
			FROM
			 	products
			WHERE
				products.status  != 'deleted' AND
				(products.barcode = '$_barcode' OR products.barcode2 = '$_barcode')
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function by_barcode($_barcode)
	{
		$query  =
		"
			SELECT
				*
			FROM
				products
			WHERE
				products.status  != 'deleted' AND
				(products.barcode = '$_barcode' OR products.barcode2 = '$_barcode')
			LIMIT 1
		";
		$result = \dash\db::get($query, null, true);
		$result = self::load_price($result);
		return $result;
	}



	public static function scalecode($_scalecode)
	{
		$query  =
		"
			SELECT
				*
			FROM
				products
			WHERE
				products.status  != 'deleted' AND
				products.scalecode = '$_scalecode'
			LIMIT 1
		";
		$result = \dash\db::get($query, null, true);
		$result = self::load_price($result);
		return $result;
	}



	public static function one_field($_id, $_field)
	{
		$query  = "SELECT products.$_field FROM products WHERE products.id = $_id  LIMIT 1";
		$result = \dash\db::get($query, $_field, true);
		return $result;
	}


	/**
	 * Loads a price.
	 *
	 * @param      <type>  $_result      The result
	 * @param      <type>  $_one_record  One record
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function load_price($_result)
	{
		if(isset($_result['id']))
		{
			$query = "SELECT * FROM productprices WHERE productprices.product_id = $_result[id] ORDER BY productprices.id DESC LIMIT 1";
			$prices = \dash\db::get($query, null, true);
			if(is_array($prices))
			{
				if(array_key_exists('price', $prices)) 				$_result['price']           = $prices['price'];
				if(array_key_exists('buyprice', $prices)) 			$_result['buyprice']        = $prices['buyprice'];
				if(array_key_exists('discount', $prices)) 			$_result['discount']        = $prices['discount'];
				if(array_key_exists('compareatprice', $prices)) 	$_result['compareatprice']  = $prices['compareatprice'];
				if(array_key_exists('discountpercent', $prices)) 	$_result['discountpercent'] = $prices['discountpercent'];
				if(array_key_exists('finalprice', $prices)) 		$_result['finalprice']      = $prices['finalprice'];
			}
		}

		return $_result;
	}


	public static function by_id($_id)
	{
		$query  = "SELECT * FROM products WHERE products.id = $_id	LIMIT 1	";
		$result = \dash\db::get($query, null, true);
		$result = self::load_price($result);
		return $result;
	}



	/**
	 * Get multi product by id
	 * Call in factor add to check multi product and add new factor
	 *
	 * @param      <type>  $_ids   The identifiers
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function by_multi_id($_ids)
	{
		$query  =
		"
			SELECT
				products.*,
				productprices.buyprice,
				productprices.price,
				productprices.discount,
				productprices.discountpercent,
				productprices.compareatprice,
				productprices.finalprice
			FROM products
			LEFT JOIN productprices ON productprices.id = (SELECT MAX(productprices.id) FROM productprices WHERE productprices.product_id = products.id)
			WHERE products.id IN ($_ids)
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function check_unique_sku($_sku)
	{
		$query = "SELECT `id`, `sku` FROM products WHERE products.sku = '$_sku' AND products.status  != 'deleted' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function one($_id)
	{
		$query  = "SELECT * FROM products WHERE products.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function duplicate_id()
	{
		$query =
		"
			SELECT
				products.id
			FROM
				products
			INNER JOIN
				(
					SELECT
						title
					FROM
						products
					GROUP BY title
					HAVING COUNT(*) > 1
				) dup
			   ON products.title = dup.title
		";
		$result = \dash\db::get($query, 'id');

		return $result;
	}



	public static function variants_have_child($_id)
	{
		$query  = "SELECT products.id AS `id` FROM products WHERE products.parent = $_id LIMIT 1";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}


	public static function variants_load_child($_id)
	{
		$query  = "SELECT * FROM products WHERE products.parent = $_id";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function variants_load_child_count($_products_ids)
	{
		$query  =
		"
			SELECT
				products.parent,
				COUNT(*) AS `count`
			FROM
				products
			WHERE
				products.parent IN ($_products_ids)
			GROUP BY products.parent
		";
		$result = \dash\db::get($query);
		return $result;
	}

}
?>