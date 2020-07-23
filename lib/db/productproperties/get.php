<?php
namespace lib\db\productproperties;

class get
{
	public static function all_cat_name()
	{
		$query = "SELECT DISTINCT productproperties.cat AS `cat` FROM productproperties";
		$result = \dash\db::get($query, 'cat');
		return $result;
	}

	public static function all_key_name()
	{
		$query = "SELECT DISTINCT productproperties.key AS `key` FROM productproperties";
		$result = \dash\db::get($query, 'key');
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
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function one($_id, $_product_id)
	{
		$query  = "SELECT * FROM productproperties WHERE productproperties.id = $_id AND productproperties.product_id = $_product_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
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
		$result = \dash\db::get($query);
		return $result;
	}

}
?>