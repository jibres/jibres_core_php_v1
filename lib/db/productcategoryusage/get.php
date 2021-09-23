<?php
namespace lib\db\productcategoryusage;


class get
{

	public static function get_product_id_in_category_ids($_product_ids, $_category_ids)
	{
		$query =
		"
			SELECT
				productcategoryusage.product_id AS `product_id`
			FROM
				productcategoryusage
			WHERE
				productcategoryusage.product_id IN ($_product_ids) AND
				productcategoryusage.productcategory_id IN ($_category_ids)
		";
		$result = \dash\db::get($query, 'product_id');
		return $result;
	}


	public static function usage($_product_id)
	{
		if(!$_product_id)
		{
			return false;
		}

		$query =
		"
			SELECT
				productcategory.id AS `productcategory_id`,
				productcategory.title,
				productcategory.slug
			FROM
				productcategoryusage
			INNER JOIN productcategory ON productcategory.id = productcategoryusage.productcategory_id
			WHERE
				productcategoryusage.product_id = $_product_id
			ORDER BY productcategoryusage.id ASC
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function check_usage_category($_category_id)
	{
		$query  = "SELECT * FROM productcategoryusage WHERE productcategoryusage.productcategory_id = $_category_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function check_product_have_cat($_product_id, $_category_id)
	{
		$query  = "SELECT * FROM productcategoryusage WHERE productcategoryusage.productcategory_id = $_category_id AND productcategoryusage.product_id = $_product_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;

	}


}
?>
