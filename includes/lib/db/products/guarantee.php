<?php
namespace lib\db\products;


class guarantee
{
	// get count of produc by one guarantee
	public static function get_count_guarantee($_store_id, $_guarantee_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM products WHERE products.store_id = $_store_id AND products.guarantee_id = $_guarantee_id";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function update_all_product_guarantee_title($_store_id, $_guarantee_id, $_new_guarantee_title)
	{
		if(is_null($_new_guarantee_title))
		{
			$_new_guarantee_title = "NULL";
		}
		else
		{
			$_new_guarantee_title = \dash\db\safe::value($_new_guarantee_title);
			$_new_guarantee_title = "'$_new_guarantee_title'";
		}

		$query =
		"
			UPDATE
				products
			SET
				products.guarantee    = $_new_guarantee_title
			WHERE
				products.store_id = $_store_id AND
				products.guarantee_id  = $_guarantee_id
		";

		$result = \dash\db::query($query);
		return $result;

	}

		// update all product guarantee by new guarantee
	public static function update_all_product_by_guarantee($_store_id, $_new_guarantee_id, $_new_guarantee_title, $_old_guarantee_id)
	{
		if(is_null($_new_guarantee_id))
		{
			$_new_guarantee_id = "NULL";
		}

		if(is_null($_new_guarantee_title))
		{
			$_new_guarantee_title = "NULL";
		}
		else
		{
			$_new_guarantee_title = \dash\db\safe::value($_new_guarantee_title);
			$_new_guarantee_title = "'$_new_guarantee_title'";
		}


		$query =
		"
			UPDATE
				products
			SET
				products.guarantee    = $_new_guarantee_title,
				products.guarantee_id = $_new_guarantee_id
			WHERE
				products.store_id = $_store_id AND
				products.guarantee_id  = $_old_guarantee_id
		";

		$result = \dash\db::query($query);
		return $result;
	}


}
?>
