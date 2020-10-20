<?php
namespace lib\db\cart;


class delete
{

	public static function by_user_id($_user_id)
	{
		$query  = "DELETE FROM cart WHERE cart.user_id = $_user_id ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function by_guest_id($_guest_id)
	{
		$query  = "DELETE FROM cart WHERE cart.guestid = '$_guest_id' ";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function must_deleted_expired($_date)
	{
		$query   = "DELETE FROM cart WHERE cart.user_id IS NULL AND cart.datecreated < '$_date' ";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function by_product_user($_product_id, $_user_id)
	{
		$query  = "DELETE FROM cart WHERE cart.product_id = $_product_id AND cart.user_id = $_user_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function by_product_user_guest($_product_id, $_guest_id)
	{
		$query  = "DELETE FROM cart WHERE cart.product_id = $_product_id AND cart.guestid = '$_guest_id' LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function drop_cart($_user_id)
	{
		$query  = "DELETE FROM cart WHERE  cart.user_id = $_user_id ";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function drop_cart_guest($_guest_id)
	{
		$query  = "DELETE FROM cart WHERE  cart.guestid = '$_guest_id' ";
		$result = \dash\db::query($query);
		return $result;
	}



	public static function autoremove_product_user_id($_product_ids, $_user_id)
	{
		$query  = "DELETE FROM cart WHERE cart.user_id = $_user_id AND cart.product_id IN ($_product_ids) ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function autoremove_product_guestid($_product_ids, $_guestid)
	{
		$query  = "DELETE FROM cart WHERE cart.guestid = '$_guestid' AND cart.product_id IN ($_product_ids) ";
		$result = \dash\db::query($query);
		return $result;
	}




}
?>