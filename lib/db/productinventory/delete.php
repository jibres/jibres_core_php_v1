<?php
namespace lib\db\productinventory;


class delete
{
	public static function by_product_id($_product_id)
	{
		$query = "DELETE FROM productinventory WHERE productinventory.product_id = $_product_id ";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>