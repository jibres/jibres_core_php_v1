<?php
namespace lib\db\cart;


class get
{

	public static function count_all()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM cart ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function product_user($_product_id, $_user_id)
	{
		$query  = "SELECT * FROM cart WHERE cart.product_id = $_product_id AND cart.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function multi_product_user($_product_ids, $_user_id)
	{
		$query  = "SELECT cart.product_id AS `product_id` FROM cart WHERE cart.product_id IN ($_product_ids) AND cart.user_id = $_user_id";
		$result = \dash\db::get($query, 'product_id');
		return $result;
	}


	public static function user_cart($_user_id)
	{
		$query  = "SELECT * FROM cart WHERE cart.user_id = $_user_id";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>