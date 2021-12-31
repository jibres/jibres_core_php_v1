<?php
namespace content_a\buy\opr;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Check buy order'));


		$dataRow = \dash\data::dataRow();
		$load_order_detail = \lib\app\order\get::detail_by_order_id($dataRow['id']);
		$load_order_detail = \lib\app\order\get::buy_opr_merger_duplicate($load_order_detail);

		\dash\data::orderDetail($load_order_detail['list']);
		\dash\data::orderMeta($load_order_detail['detail']);

		\dash\data::back_text(T_('Factors'));
		\dash\data::back_link(\dash\url::here(). '/order?type=buy');

		\dash\face::btnView(\dash\url::here(). '/order/detail?id='. \dash\request::get('id'));


		\dash\face::btnSave('saveOpt');
		\dash\face::btnSaveText(T_("Save"));

		\dash\face::btnNext(\dash\url::this(). '/next/'. \dash\request::get('id'). '?c='. \dash\url::child());
		\dash\face::btnPrev(\dash\url::this(). '/prev/'. \dash\request::get('id'). '?c='. \dash\url::child());

	}
}
?>
