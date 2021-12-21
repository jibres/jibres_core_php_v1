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
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function first_sale($_product_id)
	{
		$query = "SELECT * FROM factordetails INNER JOIN factors ON factors.id = factordetails.factor_id WHERE factordetails.product_id = $_product_id AND factors.status != 'deleted' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_id($_id)
	{
		$query = "SELECT * FROM factordetails WHERE factordetails.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_factor_id($_id)
	{
		$query = "SELECT * FROM factordetails WHERE factordetails.factor_id = $_id";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function get_product_by_factor_id($_factor_id)
	{
		$query =
		"
			SELECT
				products.*,
				factordetails.product_id as `id`,
				factordetails.price AS `price`,
				factordetails.discount AS `discount`,
				factordetails.finalprice AS `finalprice`,
				factordetails.vat AS `vat`,
				factordetails.count AS `count`,
				factordetails.sum AS `sum`,
				(IF(products.thumb IS NULL AND products.parent IS NOT NULL, (SELECT pProduct.thumb FROM products AS pProduct WHERE pProduct.id = products.parent LIMIT 1), products.thumb)) AS `thumb`,
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
		$result = \dash\pdo::get($query);
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
		$result = \dash\pdo::get($query);
		return $result;
	}



	public static function sum_detail($_factor_id)
	{
		$query =
		"
			SELECT
				COUNT(*) 					AS `item`,
				SUM(factordetails.count) 	AS `qty`,
				SUM(factordetails.price * factordetails.count) 	AS `subprice`,
				SUM(factordetails.discount * factordetails.count) AS `subdiscount`,
				SUM(factordetails.vat * factordetails.count) 		AS `subvat`,
				SUM(factordetails.finalprice * factordetails.count) AS `subtotal`
			FROM
				factordetails
			WHERE
				factordetails.factor_id = $_factor_id AND
				factordetails.status = 'enable'
		";
		$result = \dash\db::get($query, null, true);
		return $result;
	}





	public static function product_neet_track_count($_factor_id)
	{
		$query =
		"
			SELECT
				SUM(factordetails.count) 	AS `count`,
				factordetails.product_id AS `product_id`
			FROM
				factordetails
			INNER JOIN products ON products.id = factordetails.product_id
			WHERE
				factordetails.factor_id  = $_factor_id AND
				factordetails.status     = 'enable' AND
				products.trackquantity = 'yes'
			GROUP BY factordetails.product_id
		";

		$result = \dash\pdo::get($query);

		return $result;
	}





	public static function by_factor_id_product_id($_factor_id, $_product_id)
	{
		$query = "SELECT * FROM factordetails WHERE factordetails.factor_id = $_factor_id AND factordetails.product_id = $_product_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function check_exist_record($_factor_id, $_product_id, $_price, $_discount)
	{
		if(!$_discount)
		{
			$discount = ' AND ( factordetails.discount = 0 OR factordetails.discount IS NULL )';
		}
		else
		{
			$discount = " AND  factordetails.discount = $_discount ";
		}

		if(!$_price)
		{
			$price = ' AND ( factordetails.price = 0 OR factordetails.price IS NULL )';
		}
		else
		{
			$price = " AND  factordetails.price = $_price ";
		}

		$query = "SELECT * FROM factordetails WHERE factordetails.factor_id = $_factor_id AND factordetails.product_id = $_product_id $price $discount LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function by_id_factor_id($_id, $_factor_id)
	{
		$query = "SELECT * FROM factordetails WHERE factordetails.id = $_id AND factordetails.factor_id = $_factor_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function product_ordered_stat($_product_id)
	{
		$query =
		"
			SELECT
				SUM(factordetails.count) AS `total`,
				COUNT(factordetails.id) AS `count`
			FROM
				factordetails
			INNER JOIN factors ON factors.id = factordetails.factor_id
			WHERE
				factordetails.product_id = :product_id AND
				factors.type  IN ('sale', 'saleorder') AND
				factordetails.count > 0
		";

		$param  = [':product_id' => $_product_id];
		$result = \dash\db::get_bind($query, $param, null, true);

		return $result;
	}

}
?>
