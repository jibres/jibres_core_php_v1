<?php
namespace lib\db\productcategoryusage;


class delete
{

	public static function category_usage_cat_id($_id)
	{
		$query  = "DELETE FROM productcategoryusage WHERE productcategoryusage.productcategory_id = $_id ";
		$result = \dash\pdo::query($query, []);
		return $result;
	}




	public static function hard_delete_product_category($_product_category_ids, $_product_id)
	{
		$query = "DELETE FROM productcategoryusage WHERE productcategoryusage.productcategory_id IN ($_product_category_ids) AND productcategoryusage.product_id = $_product_id ";
		return \dash\pdo::query($query, []);
	}


	public static function hard_delete_all_product_cat($_product_id)
	{
		$query = "DELETE FROM productcategoryusage WHERE productcategoryusage.product_id = $_product_id ";
		return \dash\pdo::query($query, []);
	}

}
?>
