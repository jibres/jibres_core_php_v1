<?php
namespace lib\db\cart;


class get
{

	public static function product_user($_product_id, $_user_id)
	{
		$query  = "SELECT * FROM cart WHERE cart.product_id = $_product_id AND cart.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>