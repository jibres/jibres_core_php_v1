<?php
namespace lib\db\productstock;


class update
{

	public static function by_product_id($_args, $_product_id)
	{
		$set    = \dash\db\config::make_set($_args);
		$query  = "UPDATE productstock SET $set WHERE productstock.product_id = $_product_id  LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>