<?php
namespace lib\db\productproperties;

class get
{
	public static function all_cat_name()
	{
		$query = "SELECT DISTINCT productproperties.cat AS `cat` FROM productproperties ORDER BY CHAR_LENGTH(productproperties.cat) ASC";
		$result = \dash\pdo::get($query, [], 'cat');
		return $result;
	}

	public static function all_key_name()
	{
		$query = "SELECT DISTINCT productproperties.key AS `key` FROM productproperties ORDER BY CHAR_LENGTH(productproperties.key) ASC";
		$result = \dash\pdo::get($query, [], 'key');
		return $result;
	}


	public static function last_sort_cat($_product_id, $_cat)
	{
		$query  = "SELECT IFNULL(productproperties.sort, 0) AS `sort` FROM productproperties WHERE productproperties.product_id = $_product_id AND productproperties.cat = '$_cat' ORDER BY productproperties.sort DESC LIMIT 1 ";
		$result = \dash\pdo::get($query, [], 'sort', true);
		return $result;
	}

	public static function count_product($_product_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM productproperties WHERE productproperties.product_id = $_product_id  ";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}


	public static function property_cat_name($_category_id)
	{
		$query =
		"
		SELECT DISTINCT
				productproperties.cat AS `cat`
			FROM
				productproperties
			INNER JOIN productcategoryusage ON productcategoryusage.product_id = productproperties.product_id
			WHERE
				productcategoryusage.productcategory_id = $_category_id
		";
		$result = \dash\pdo::get($query, [], 'cat');
		return $result;
	}


	public static function property_key_name($_category_id)
	{
		$query =
		"
			SELECT DISTINCT
				productproperties.key AS `key`
			FROM
				productproperties
			INNER JOIN productcategoryusage ON productcategoryusage.product_id = productproperties.product_id
			WHERE
				productcategoryusage.productcategory_id = $_category_id
		";
		$result = \dash\pdo::get($query, [], 'key');
		return $result;
	}


	public static function check_duplicate_cat_key($_cat, $_key, $_product_id)
	{
		$query =
		"
			SELECT *
			FROM productproperties
			WHERE
				productproperties.product_id = '$_product_id' AND
				productproperties.cat = '$_cat' AND
				productproperties.key = '$_key'
			LIMIT 1
		";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function check_duplicate($_cat, $_key, $_value, $_product_id)
	{
		$query =
		"
			SELECT *
			FROM productproperties
			WHERE
				productproperties.product_id = '$_product_id' AND
				productproperties.cat = '$_cat' AND
				productproperties.key = '$_key' AND
				productproperties.value = '$_value'
			LIMIT 1
		";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function one($_id, $_product_id)
	{
		$query  = "SELECT * FROM productproperties WHERE productproperties.id = $_id AND productproperties.product_id = $_product_id LIMIT 1 ";
		$result = \dash\pdo::get($query, [], null, true);
		return $result;
	}


	public static function product_property_list($_product_id, $_parent_id = null)
	{
		$parent = null;

		if($_parent_id && is_numeric($_parent_id))
		{
			$parent = " OR productproperties.product_id = $_parent_id ";
		}
		$query  = "SELECT * FROM productproperties WHERE productproperties.product_id = $_product_id $parent ORDER BY productproperties.sort ASC ";
		$result = \dash\pdo::get($query);
		return $result;
	}

}
?>