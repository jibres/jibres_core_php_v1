<?php
namespace lib\db\factordetails;

class get
{

	public static function count_all()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM factordetails ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function by_multi_factor_id($_ids)
	{
		$query = "SELECT * FROM factordetails WHERE factordetails.factor_id IN ($_ids)";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function first_sale($_product_id)
	{
		$query = "SELECT * FROM factordetails INNER JOIN factors ON factors.id = factordetails.factor_id WHERE factordetails.product_id = $_product_id AND factors.status != 'deleted' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_factor_id($_id)
	{
		$query = "SELECT * FROM factordetails WHERE factordetails.factor_id = $_id";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function get_product_by_factor_id($_factor_id)
	{
		$query =
		"
			SELECT
				factordetails.product_id as `id`,
				factordetails.price AS `price`,
				factordetails.discount AS `discount`,
				factordetails.finalprice AS `finalprice`,
				factordetails.vat AS `vat`,
				factordetails.count AS `count`,
				factordetails.sum AS `sum`,
				(IF(products.thumb IS NULL AND products.parent IS NOT NULL, (SELECT pProduct.thumb FROM products AS pProduct WHERE pProduct.id = products.parent LIMIT 1), products.thumb)) AS `thumb`,
				products.title,
				products.trackquantity,
				products.instock,
				products.status,
				products.optionname1,
				products.optionvalue1,
				products.optionname2,
				products.optionvalue2,
				products.optionname3,
				products.optionvalue3,
				products.price AS `product_price`,
				(SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) AS `stock`,
				productunit.title AS `unit`
			FROM
				factordetails
			INNER JOIN products ON products.id = factordetails.product_id
			LEFT JOIN productunit ON productunit.id = products.unit_id

			WHERE
				factordetails.factor_id = $_factor_id
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function by_factor_id_join_product($_id)
	{
		$query =
		"
			SELECT
				factordetails.*,
				products.title,
				products.trackquantity,
				products.instock,
				products.status,
				products.optionname1,
				products.optionvalue1,
				products.optionname2,
				products.optionvalue2,
				products.optionname3,
				products.optionvalue3,
				products.thumb,
				products.price AS `product_price`,
				(SELECT productinventory.stock FROM productinventory WHERE productinventory.product_id = products.id ORDER BY productinventory.id DESC LIMIT 1) AS `stock`,
				productunit.title AS `unit`
			FROM
				factordetails
			INNER JOIN products ON products.id = factordetails.product_id
			LEFT JOIN productunit ON productunit.id = products.unit_id

			WHERE
				factordetails.factor_id = $_id
		";
		$result = \dash\db::get($query);
		return $result;
	}



	public static function by_factor_id_product_id($_factor_id, $_product_id)
	{
		$query = "SELECT * FROM factordetails WHERE factordetails.factor_id = $_factor_id AND factordetails.product_id = $_product_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function by_id_factor_id($_id, $_factor_id)
	{
		$query = "SELECT * FROM factordetails WHERE factordetails.id = $_id AND factordetails.factor_id = $_factor_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function product_sold($_product_id)
	{
		$query =
		"
			SELECT
				SUM(factordetails.count) AS `count`
			FROM
				factordetails
			WHERE
				factordetails.product_id = $_product_id AND
				factordetails.count > 0
		";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function product_bougth($_product_id)
	{
		$query =
		"
			SELECT
				(SUM(factordetails.count) * -1) AS `count`
			FROM
				factordetails
			WHERE
				factordetails.product_id = $_product_id AND
				factordetails.count < 0
		";
		$result = \dash\db::get($query, 'count', true);
		return $result;

	}



}
?>
