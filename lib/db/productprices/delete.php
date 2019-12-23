<?php
namespace lib\db\productprices;


class delete
{

	public static function by_product_id($_product_id)
	{
		$query = "DELETE FROM productprices WHERE productprices.product_id = $_product_id ";
		return \dash\db::query($query);
	}
}
?>
