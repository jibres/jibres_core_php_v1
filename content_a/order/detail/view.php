<?php
namespace content_a\order\detail;


class view
{
	public static function config()
	{
		\content_a\order\view::master_order_view();

		$orderDetail = \dash\data::orderDetail();
		if(($customer_id = a($orderDetail, 'factor', 'customer')))
		{
			$customer_debt = \lib\app\order\get::customer_debt($orderDetail['factor']['id'], $customer_id, $orderDetail['factor']['total']);
			\dash\data::customerDebt($customer_debt);
        }

	}
}
?>
