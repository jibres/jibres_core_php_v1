<?php
namespace lib\db\productstock;


class delete
{

	public static function by_product_id($_product_id)
	{
		$query  = "DELETE FROM productstock WHERE productstock.product_id = $_product_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>