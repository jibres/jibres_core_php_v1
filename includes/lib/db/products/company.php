<?php
namespace lib\db\products;

class company
{
	// get count of produc by one company
	public static function get_count_company($_store_id, $_company_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM products WHERE products.store_id = $_store_id AND products.company_id = $_company_id";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function update_all_product_company_title($_store_id, $_company_id, $_new_company_title)
	{
		if(is_null($_new_company_title))
		{
			$_new_company_title = "NULL";
		}
		else
		{
			$_new_company_title = \dash\db\safe::value($_new_company_title);
			$_new_company_title = "'$_new_company_title'";
		}

		$query =
		"
			UPDATE
				products
			SET
				products.company    = $_new_company_title
			WHERE
				products.store_id = $_store_id AND
				products.company_id  = $_company_id
		";

		$result = \dash\db::query($query);
		return $result;

	}

		// update all product company by new company
	public static function update_all_product_by_company($_store_id, $_new_company_id, $_new_company_title, $_old_company_id)
	{
		if(is_null($_new_company_id))
		{
			$_new_company_id = "NULL";
		}

		if(is_null($_new_company_title))
		{
			$_new_company_title = "NULL";
		}
		else
		{
			$_new_company_title = \dash\db\safe::value($_new_company_title);
			$_new_company_title = "'$_new_company_title'";
		}


		$query =
		"
			UPDATE
				products
			SET
				products.company    = $_new_company_title,
				products.company_id = $_new_company_id
			WHERE
				products.store_id = $_store_id AND
				products.company_id  = $_old_company_id
		";

		$result = \dash\db::query($query);
		return $result;
	}


}
?>
