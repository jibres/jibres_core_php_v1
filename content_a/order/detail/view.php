<?php
namespace content_a\order\detail;


class view
{
	public static function config()
	{

		\dash\face::title(T_('Order detail'));

		\dash\data::back_text(T_('Orders'));
		\dash\data::back_link(\dash\url::this());

		$orderDetail = \dash\data::orderDetail();

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
	}
}
?>
