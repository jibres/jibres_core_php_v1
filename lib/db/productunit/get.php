<?php
namespace lib\db\productunit;


class get
{

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
		$query  = "SELECT * FROM productunit WHERE  productunit.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
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
