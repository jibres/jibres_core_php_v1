<?php
namespace content_a\order;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Orders'));

		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());


		\dash\data::action_text(T_('Add order'));
		\dash\data::action_link(\dash\url::this(). '/add');
	}


	public static function master_order_view()
	{
		$orderDetail = \dash\data::orderDetail();

		$factor_id = null;

		if(isset($orderDetail['factor']['id_code']))
		{
			$factor_id = $orderDetail['factor']['id_code'];
		}

		\dash\face::title(T_('Order Edit'). ' '. $factor_id);

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		\dash\face::btnNext(\dash\url::this(). '/next/'. \dash\request::get('id'). '?c='. \dash\url::child());
		\dash\face::btnPrev(\dash\url::this(). '/prev/'. \dash\request::get('id'). '?c='. \dash\url::child());
	}
}
?>
