<?php
namespace lib\db\productproperties;

class get
{

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