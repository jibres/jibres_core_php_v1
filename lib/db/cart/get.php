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


	public static function product_user_guest($_product_id, $_guestid)
	{
		$query  = "SELECT * FROM cart WHERE cart.product_id = $_product_id AND cart.guestid = '$_guestid' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}




	public static function multi_product_user($_product_ids, $_user_id)
	{
		$query  = "SELECT cart.product_id AS `product_id` FROM cart WHERE cart.product_id IN ($_product_ids) AND cart.user_id = $_user_id";
		$result = \dash\db::get($query, 'product_id');
		return $result;
	}


	public static function admin_dashboard()
	{
		$query  =
		"
			SELECT
				COUNT(*) AS `item`,
				SUM(cart.count) AS `product`,
				SUM(cart.price) AS `price`
			FROM
				cart
		";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function count_cart()
	{
		$query  =
		"
			SELECT
				COUNT(DISTINCT IFNULL(cart.user_id, cart.guestid)) AS `count`
			FROM
				cart
		";
		$result = \dash\db::get($query, 'count', true);

		return $result;
	}


	public static function user_cart_count($_user_id)
	{
		$query  = "SELECT SUM(cart.count) AS `count` FROM cart WHERE cart.user_id = $_user_id";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function user_cart_count_guest($_guestid)
	{
		$query  = "SELECT SUM(cart.count) AS `count` FROM cart WHERE cart.guestid = '$_guestid' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}



	public static function user_cart($_user_id)
	{
		$query  = "SELECT cart.product_id, cart.count, cart.datecreated FROM cart WHERE cart.user_id = $_user_id";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function user_cart_guest($_guestid)
	{
		$query  = "SELECT cart.product_id, cart.count, cart.datecreated FROM cart WHERE cart.guestid = '$_guestid' ";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>