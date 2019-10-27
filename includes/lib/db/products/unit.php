<?php
namespace lib\db\products;

class unit
{
	// get count of produc by one unit
	public static function get_count_unit($_store_id, $_unit_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM products WHERE products.store_id = $_store_id AND products.unit_id = $_unit_id";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function update_all_product_unit_title($_store_id, $_unit_id, $_new_unit_title)
	{
		if(is_null($_new_unit_title))
		{
			$_new_unit_title = "NULL";
		}
		else
		{
			$_new_unit_title = \dash\db\safe::value($_new_unit_title);
			$_new_unit_title = "'$_new_unit_title'";
		}

		$query =
		"
			UPDATE
				products
			SET
				products.unit    = $_new_unit_title
			WHERE
				products.store_id = $_store_id AND
				products.unit_id  = $_unit_id
		";

		$result = \dash\db::query($query);
		return $result;

	}

		// update all product unit by new unit
	public static function update_all_product_by_unit($_store_id, $_new_unit_id, $_new_unit_title, $_old_unit_id)
	{
		if(is_null($_new_unit_id))
		{
			$_new_unit_id = "NULL";
		}

		if(is_null($_new_unit_title))
		{
			$_new_unit_title = "NULL";
		}
		else
		{
			$_new_unit_title = \dash\db\safe::value($_new_unit_title);
			$_new_unit_title = "'$_new_unit_title'";
		}


		$query =
		"
			UPDATE
				products
			SET
				products.unit    = $_new_unit_title,
				products.unit_id = $_new_unit_id
			WHERE
				products.store_id = $_store_id AND
				products.unit_id  = $_old_unit_id
		";

		$result = \dash\db::query($query);
		return $result;
	}


}
?>
