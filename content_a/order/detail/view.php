<?php
namespace content_a\order\detail;


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



		$payment_detail = \lib\app\setting\setup::ready('payment', true);

		$myPaymentDetail = [];

		if(is_array($payment_detail))
		{
			foreach ($payment_detail as $key => $value)
			{
				if(substr($key, 0, 8) === 'payment_')
				{
					$myPaymentDetail[$key] = $value;
				}
			}
		}

		\dash\data::paymentDetail($myPaymentDetail);

		\dash\data::maxUploadSize(\dash\upload\size::MB(1, true));

	}
}
?>
