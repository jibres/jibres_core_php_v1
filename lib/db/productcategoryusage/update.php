<?php
namespace lib\db\productcategoryusage;


class update
{



	public static function category_usage_cat_id($_old_id, $_new_id)
	{
		$query  = "UPDATE productcategoryusage SET productcategoryusage.productcategory_id = $_new_id WHERE productcategoryusage.productcategory_id = $_old_id ";
		$result = \dash\db::query($query);
		return $result;
	}


}
?>
