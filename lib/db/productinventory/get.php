<?php
namespace lib\db\productinventory;


class get
{

	public static function product_last_record($_product_id)
	{
		$query = "SELECT * FROM productinventory WHERE productinventory.product_id = $_product_id ORDER BY productinventory.id DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>