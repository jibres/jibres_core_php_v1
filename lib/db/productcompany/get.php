<?php
namespace lib\db\productcompany;


class get
{

	public static function count_all()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM productcompany ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function list()
	{
		$query =
		"
			SELECT
				productcompany.id,
				productcompany.title,
				(SELECT COUNT(*) FROM products WHERE products.company_id = productcompany.id) AS `count`
			FROM
				productcompany
			ORDER BY
				count DESC
		";
		$result = \dash\db::get($query);

		return $result;
	}



	// get one record of product company
	public static function one($_id)
	{
		$query  = "SELECT productcompany.*, (SELECT COUNT(*) FROM products WHERE products.company_id = $_id) AS `count` FROM productcompany WHERE  productcompany.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function count_company($_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM products WHERE products.company_id = $_id ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	// get one company by title to check is duplicate title or no
	public static function by_title($_title)
	{
		$query =
		"
			SELECT
				productcompany.id,
				productcompany.title
			FROM
				productcompany
			WHERE
				productcompany.title = '$_title'
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>
