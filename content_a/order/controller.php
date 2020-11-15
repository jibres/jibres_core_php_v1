<?php
namespace content_a\order;


class controller
{
	public static function routing()
	{
		\dash\permission::access('factorSaleAdd');
	}


	/**
	 * Loads an order.
	 */
	public static function load_order()
	{
		\dash\permission::access('factorSaleAdd');

		$id = \dash\request::get('id');

		$orderDetail = \lib\app\factor\get::full($id);

		if(!$orderDetail)
		{
			\dash\header::status(403, T_("Invalid order id"));
		}

		\dash\data::orderDetail($orderDetail);
	}
}
?>
