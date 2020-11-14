<?php
namespace content_a\order\status;


class controller
{
	public static function routing()
	{
		\dash\permission::access('factorSaleAdd');

		// load order

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
