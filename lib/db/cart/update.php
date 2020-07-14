<?php
namespace lib\db\cart;


class update
{

	public static function the_count($_product_id, $_user_id, $_count)
	{
		$query  = "UPDATE cart SET cart.count = $_count WHERE cart.product_id = $_product_id AND cart.user_id = $_user_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function the_count_guest($_product_id, $_guestid, $_count)
	{
		$query  = "UPDATE cart SET cart.count = $_count WHERE cart.product_id = $_product_id AND cart.guestid = '$_guestid' LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}




	public static function set_view_user_id($_user_id)
	{
		$query  = "UPDATE cart SET cart.view = 1 WHERE cart.user_id = $_user_id ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function set_view_guestid($_guestid)
	{
		$query  = "UPDATE cart SET cart.view = 1 WHERE cart.guestid = '$_guestid' ";
		$result = \dash\db::query($query);
		return $result;
	}






}
?>