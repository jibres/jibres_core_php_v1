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
				products.title,
				products.slug,
				products.thumb,
				products.trackquantity,
				products.instock,
				products.status,
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
				products.title AS `title`,
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
