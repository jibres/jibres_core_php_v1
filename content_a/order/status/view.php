<?php
namespace content_a\order\status;


class view
{
	public static function config()
	{
		$orderDetail = \dash\data::orderDetail();

		$factor_id = null;

		if(isset($orderDetail['factor']['id_code']))
		{
			$factor_id = $orderDetail['factor']['id_code'];
		}

		\dash\face::title(T_('Order Edit'). ' '. $factor_id);

		\dash\data::back_text(T_('Detail'));
		\dash\data::back_link(\dash\url::this(). '/detail?id='. \dash\request::get('id'));

	}
}
?>
