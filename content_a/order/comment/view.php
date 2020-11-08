<?php
namespace content_a\order\comment;


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

		\dash\face::title(T_('Order detail'). ' '. $factor_id);

		\dash\data::back_text(T_('Orders'));
		\dash\data::back_link(\dash\url::this());


		\dash\data::maxUploadSize(\dash\upload\size::MB(1, true));

		\dash\face::btnNext(\dash\url::this(). '/next/'. \dash\request::get('id'));
		\dash\face::btnPrev(\dash\url::this(). '/prev/'. \dash\request::get('id'));

	}
}
?>
