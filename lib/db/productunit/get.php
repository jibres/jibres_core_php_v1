<?php
namespace lib\db\productunit;


class get
{


	public static function count_all()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM productunit ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}



	public static function list()
	{
		$query =
		"
			SELECT
				productunit.id,
				productunit.title,
				productunit.int,
				(SELECT COUNT(*) FROM products WHERE products.unit_id = productunit.id) AS `count`
			FROM
				productunit
			ORDER BY
				count DESC
		";
		$result = \dash\db::get($query);

		return $result;
	}



	// get one record of product unit
	public static function one($_id)
	{
		$query  = "SELECT productunit.*, (SELECT COUNT(*) FROM products WHERE products.unit_id = $_id) AS `count` FROM productunit WHERE  productunit.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function count_unit($_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM products WHERE products.unit_id = $_id ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	// get one unit by title to check is duplicate title or no
	public static function by_title($_title)
	{
		$query =
		"
			SELECT
				productunit.id,
				productunit.title
			FROM
				productunit
			WHERE
				productunit.title = '$_title'
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>
