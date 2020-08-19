<?php
namespace lib\db\productcategoryusage;


class delete
{


	public static function hard_delete($_where)
	{
		$where = \dash\db\config::make_where($_where);
		if($where)
		{
			$query = "DELETE FROM productcategoryusage WHERE $where ";
			return \dash\db::query($query);
		}
	}


	public static function hard_delete_product_category($_product_category_ids, $_product_id)
	{
		$query = "DELETE FROM productcategoryusage WHERE productcategoryusage.productcategory_id IN ($_product_category_ids) AND productcategoryusage.product_id = $_product_id ";
		return \dash\db::query($query);
	}


	public static function hard_delete_all_product_cat($_product_id)
	{
		$query = "DELETE FROM productcategoryusage WHERE productcategoryusage.product_id = $_product_id ";
		return \dash\db::query($query);
	}

}
?>
