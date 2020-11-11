<?php
namespace lib\db\productinventory;


class get
{
	public static function sum_stock($_product_id)
	{
		$query = "SELECT SUM(productinventory.count) AS `stock` FROM productinventory WHERE productinventory.product_id = $_product_id ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function product_last_record($_product_id)
	{
		$query = "SELECT * FROM productinventory WHERE productinventory.product_id = $_product_id ORDER BY productinventory.id DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function by_factor_id($_factor_id)
	{
		$query = "SELECT * FROM productinventory WHERE productinventory.factor_id = $_factor_id ";
		$result = \dash\db::get($query);
		return $result;
	}


	/**
	 * This product have child
	 * Need to calculate all child inventory
	 *
	 * @param      <type>   $_product_id  The product identifier
	 *
	 * @return     integer  ( description_of_the_return_value )
	 */
	public static function product_variant_stock($_product_id)
	{
		$query =
		"
			SELECT
				SUM(productinventory.stock) AS `stock`
			FROM
				productinventory
			WHERE
				productinventory.id IN
				(
					SELECT MAX(productinventory.id)
					FROM productinventory WHERE
					productinventory.product_id IN (SELECT products.id FROM products WHERE products.parent = $_product_id AND products.status != 'deleted')
					GROUP BY productinventory.product_id
				)
		";
		$result = \dash\db::get($query, 'stock', true);
		return floatval($result);
	}



}
?>