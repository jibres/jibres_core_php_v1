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

		if(\dash\get::index($orderDetail, 'factor', 'customer'))
		{
			$customer = \dash\get::index($orderDetail, 'factor', 'customer');

			$user_address = \dash\app\address::user_address_list($customer);

			\dash\data::customerAddress($user_address);
		}

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
