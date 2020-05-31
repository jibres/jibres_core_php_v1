<?php
namespace lib\db\productproperties;

class get
{

	public static function product_property_list($_product_id)
	{
		$query  = "SELECT * FROM productproperties WHERE productproperties.product_id = $_product_id ORDER BY productproperties.sort ASC ";
		$result = \dash\db::get($query);
		return $result;
	}

}
?>