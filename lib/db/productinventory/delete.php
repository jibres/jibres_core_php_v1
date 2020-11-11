<?php
namespace lib\db\productinventory;


class delete
{
	public static function record($_id)
	{
		$query = "DELETE FROM productinventory WHERE productinventory.id = $_id LIMIT 1 ";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function by_product_id($_product_id)
	{
		$query = "DELETE FROM productinventory WHERE productinventory.product_id = $_product_id ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function by_factor_id_product_id($_factor_id, $_product_id)
	{
		$query = "DELETE FROM productinventory WHERE productinventory.product_id = $_product_id  AND productinventory.factor_id = $_factor_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>