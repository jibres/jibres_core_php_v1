<?php
namespace lib\db\productcategory;


class get
{

	public static function all_category()
	{

		$query  = "SELECT productcategory.id, productcategory.title FROM productcategory ";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function multi_properties($_ids)
	{
		$query  = "SELECT productcategory.properties FROM productcategory WHERE productcategory.id IN ($_ids) AND productcategory.properties IS NOT NULL ";
		$result = \dash\db::get($query, 'properties');
		return $result;
	}

	public static function mulit_title($_titles)
	{
		if(!is_array($_titles) || !$_titles)
		{
			return false;
		}

		$_titles = implode("','", $_titles);

		$query =
		"
			SELECT *
			FROM productcategory
			WHERE
				productcategory.title IN ('$_titles')
		";
		$result = \dash\db::get($query);

		return $result;
	}


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

	public static function check_unique_slug($_slug)
	{
		$query  = "SELECT * FROM productcategory WHERE productcategory.slug = '$_slug' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function have_child($_id)
	{
		$query  = "SELECT id FROM productcategory WHERE productcategory.parent1 = $_id OR productcategory.parent2 = $_id OR productcategory.parent3 = $_id LIMIT 1";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}

	public static function parent_list($_id = null)
	{
		$where = null;
		if($_id)
		{
			$where = " AND productcategory.id != $_id ";
		}
		$query  =
		"
			SELECT
				productcategory.*
			FROM
				productcategory
			WHERE
				productcategory.parent3 IS NULL
				$where
		";
		$result = \dash\db::get($query);

		return $result;
	}

	public static function get_count_product($_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM productcategoryusage WHERE  productcategoryusage.productcategory_id = $_id ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}



	public static function by_muliti_id($_ids)
	{
		$query  = "SELECT id, title FROM productcategory WHERE productcategory.id IN ($_ids)";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function list($_string = null, $_args = [])
	{
		$and = [];

		if($_string)
		{
			$and[] = " productcategory.title LIKE '%$_string%' ";
		}

		if($_args)
		{
			$and[] =  \dash\db\config::make_where($_args);
		}

		$where = null;

		if(!empty($and))
		{
			$where = ' WHERE '. implode(' AND ', $and);
		}


		$query =
		"
			SELECT
				productcategory.*
			FROM
				productcategory
				$where
			ORDER BY
				count DESC

		";
		$result = \dash\db::get($query);

		// j($result);

		return $result;
	}



	public static function list_child($_category_id, $_parent_field,  $_string = null, $_parent_where = [])
	{
		$where = null;

		if($_string)
		{
			$where = " AND productcategory.title LIKE '%$_string%' ";
		}


		$parent_where = null;
		if($_parent_where)
		{
			$parent_where = " AND ". \dash\db\config::make_where($_parent_where);
		}

		$query =
		"
			SELECT
				(SELECT COUNT(*) AS `count` FROM productcategoryusage WHERE  productcategoryusage.productcategory_id = productcategory.id) AS `count`,
				productcategory.*
			FROM
				productcategory
			WHERE
				productcategory.$_parent_field = $_category_id
				$parent_where
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
				(SELECT COUNT(*) AS `count` FROM productcategoryusage WHERE  productcategoryusage.productcategory_id = productcategory.id) AS `count`,
				productcategory.*
			 FROM productcategory
			 WHERE  productcategory.id = $_id LIMIT 1
		";
		$result = \dash\db::get($query, null, true);
		return $result;
	}



	public static function by_url($_url)
	{
		$query  =
		"
			SELECT
				(SELECT COUNT(*) AS `count` FROM productcategoryusage WHERE  productcategoryusage.productcategory_id = productcategory.id) AS `count`,
				productcategory.*
			 FROM productcategory
			 WHERE  productcategory.slug = '$_url' LIMIT 1
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
