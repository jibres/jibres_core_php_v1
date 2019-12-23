<?php
namespace lib\db\productcompany;


class get
{

	public static function page_list($_string = null)
	{
		$q = null;
		if(isset($_string))
		{
			$_string = \dash\db\safe::value($_string);
			$q       = "WHERE productcompany.title LIKE '%$_string%' ";
		}

		$pagination_query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				productcompany

				$q
		";

		$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query);

		$query =
		"
			SELECT
				productcompany.id,
				productcompany.title,
				(SELECT COUNT(*) FROM products WHERE products.company_id = productcompany.id) AS `count`
			FROM
				productcompany

				$q
			ORDER BY
				count DESC
			$limit
		";
		$result = \dash\db::get($query);

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
		$query  = "SELECT * FROM productcompany WHERE  productcompany.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
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
