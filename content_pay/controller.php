<?php
namespace content_pay;


class controller
{
	public static function routing()
	{
		if(\dash\engine\store::inStore())
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
}
?>