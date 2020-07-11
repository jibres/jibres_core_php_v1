<?php
namespace lib\db\productstock;


class get
{


	public static function by_product_id($_product_id)
	{
		$query  = "SELECT * FROM productstock WHERE productstock.product_id = $_product_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>