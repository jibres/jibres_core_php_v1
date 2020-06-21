<?php
namespace lib\app\setting;


class get
{
	public static function payment()
	{
		$payment = \lib\db\setting\get::payment();
		$result = [];
		foreach ($payment as $key => $value)
		{
			if(isset($value['key']) && substr($value['key'], 0, 8) === 'payment_')
			{
				$myPaymentKeyTrans = null;
				$myPaymentKey      = substr($value['key'], 8);
				switch ($myPaymentKey)
				{
					case 'bank':
						$myPaymentKeyTrans = T_("Bank");
						break;
					case 'check':
						$myPaymentKeyTrans = T_("Cheque");
						break;
					case 'on_deliver':
						$myPaymentKeyTrans = T_("On deliver");
						break;
					case 'online':
						$myPaymentKeyTrans = T_("Online");
						break;

					default:
						// nothing
						break;
				}

				$result[$myPaymentKey] =
				[
					'key'   => $myPaymentKey,
					'title' => $myPaymentKeyTrans,
					'desc'  => null,
				];

			}
		}

		return $result;
	}



	public static function shipping_way()
	{

		$result =
		[
			'post'  => ['key' => 'post', 'title' => T_("Post")],
			'tipax' => ['key' => 'tipax', 'title' => T_("Tipax")],
		];

		return $result;
	}


	public static function product_setting()
	{
		$cat   = 'product_setting';

		$result = \lib\db\setting\get::by_cat($cat);
		if(!is_array($result))
		{
			$result = [];
		}

		$product_setting = [];

		foreach ($result as $key => $value)
		{
			if(isset($value['key']) && array_key_exists('value', $value))
			{
				$product_setting[$value['key']] = $value['value'];
			}
		}

		return $product_setting;

	}
}
?>