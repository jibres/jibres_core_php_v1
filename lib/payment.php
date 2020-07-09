<?php
namespace lib;

class payment
{

	public static function config()
	{
		$payment = \lib\store::payment_detail();

		if($payment && is_array($payment))
		{
			foreach ($payment as $payment => $detail)
			{
				if(is_array($detail))
				{
					\dash\temp::set('payment_setting_'. $payment, $detail);
				}
			}
		}
	}
}
?>