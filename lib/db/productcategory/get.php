<?php
namespace lib\db\productcategory;


class get
{

	public static function get_count_product($_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM products WHERE  products.cat_id = $_id ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function by_muliti_id($_ids)
	{
		$query  = "SELECT id, title FROM productcategory WHERE productcategory.id IN ($_ids)";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function list($_string = null)
	{
		$where = null;

		if($_string)
		{
			$where = " WHERE productcategory.title LIKE '$_string%' ";
		}

		$query =
		"
			SELECT
				productcategory.id,
				productcategory.title,
				productcategory.slug,
				productcategory.file,
				productcategory.desc,
				(SELECT COUNT(*) FROM products WHERE products.unit_id = productcategory.id) AS `count`
			FROM
				productcategory
				$where
			ORDER BY
				count DESC
		";
		$result = \dash\db::get($query);

		return $result;
	}



	// get one record of product unit
	public static function one($_id)
	{
		$query  = "SELECT * FROM productcategory WHERE  productcategory.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	// get one unit by title to check is duplicate title or no
	public static function by_title($_title)
	{
		$query =
		"
			SELECT
				productcategory.id,
				productcategory.title
			FROM
				productcategory
			WHERE
				productcategory.title = '$_title'
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true);
		return $result;
	}

}
?>
