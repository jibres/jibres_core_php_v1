<?php
namespace content_business\orders\view;


class controller
{
	public static function routing()
	{
		$order_id = \dash\request::get('id');
		if(!$order_id)
		{
			\dash\redirect::to(\dash\url::this());
		}


		$load = \lib\app\factor\get::load_my_order($order_id);
		if(!$load)
		{
			\dash\header::status(404, T_("Order not found"));
		}

		\dash\data::dataRow($load);
	}
}
?>
