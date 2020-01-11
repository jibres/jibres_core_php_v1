<?php
namespace lib\db\productcategory;


class get
{


	public static function is_parent_not_changed($_id, $_parent1, $_parent2, $_parent3)
	{
		$where =
		[
			'id'      => $_id,
			'parent1' => $_parent1,
			'parent2' => $_parent2,
			'parent3' => $_parent3,
		];

		$where  = \dash\db\config::make_where($where);
		$query  = "SELECT * FROM productcategory WHERE $where LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function check_unique_slug($_slug, $_parent1, $_parent2, $_parent3)
	{
		$where =
		[
			'slug'    => $_slug,
			'parent1' => $_parent1,
			'parent2' => $_parent2,
			'parent3' => $_parent3,
		];

		$where  = \dash\db\config::make_where($where);
		$query  = "SELECT * FROM productcategory WHERE $where LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function have_child($_id)
	{
		$query  = "SELECT id FROM productcategory WHERE productcategory.parent1 = $_id || productcategory.parent2 = $_id || productcategory.parent3 = $_id LIMIT 1";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}

	public static function parent_list()
	{
		$query  =
		"
			SELECT
				productcategory.*,
				(
					IF(productcategory.parent1 IS NOT NULL ,
					(
						SELECT JSON_ARRAYAGG(
							JSON_OBJECT(
							    'title', myPcat.title,
							    'slug', myPcat.slug,
							    'id', myPcat.id
							  )
						)
						FROM
							productcategory AS `myPcat`
						WHERE myPcat.id IN (productcategory.parent1, productcategory.parent2, productcategory.parent3)
					), NULL)
				) AS `parent_json`
			FROM
				productcategory
			WHERE
				productcategory.parent3 IS NULL
		";
		$result = \dash\db::get($query);
		return $result;
	}

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
			$where = " WHERE productcategory.title LIKE '%$_string%' ";
		}

		$query =
		"
			SELECT
				productcategory.*,
				(SELECT COUNT(*) FROM products WHERE products.cat_id = productcategory.id) AS `count`,
				(
					IF(productcategory.parent1 IS NOT NULL ,
					(
						SELECT JSON_ARRAYAGG(
							JSON_OBJECT(
							    'title', myPcat.title,
							    'slug', myPcat.slug,
							    'id', myPcat.id
							  )
						)
						FROM
							productcategory AS `myPcat`
						WHERE myPcat.id IN (productcategory.parent1, productcategory.parent2, productcategory.parent3)
					), NULL)
				) AS `parent_json`
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
		$query  =
		"
			SELECT
				(SELECT COUNT(*) FROM products WHERE products.cat_id = productcategory.id) AS `count`,
				productcategory.*,
				(
					IF(productcategory.parent1 IS NOT NULL,
					(
						SELECT JSON_ARRAYAGG(
							JSON_OBJECT(
							    'title', myPcat.title,
							    'slug', myPcat.slug,
							    'id', myPcat.id
							  )
						)
						FROM
							productcategory AS `myPcat`
						WHERE myPcat.id IN (productcategory.parent1, productcategory.parent2, productcategory.parent3)
					), NULL)
				) AS `parent_json`
			 FROM productcategory
			 WHERE  productcategory.id = $_id LIMIT 1
		";
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
