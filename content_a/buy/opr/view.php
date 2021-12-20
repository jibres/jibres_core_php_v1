<?php
namespace content_a\buy\opr;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Check buy order'));


		$dataRow = \dash\data::dataRow();
		$load_order_detail = \lib\app\order\get::detail_by_order_id($dataRow['id']);

		\dash\data::orderDetail($load_order_detail);

		\dash\data::back_text(T_('Factors'));
		\dash\data::back_link(\dash\url::here(). '/order?type=buy');


	}
}
?>
