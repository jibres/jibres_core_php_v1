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

		$setting = [];

		foreach ($result as $key => $value)
		{
			if(isset($value['key']) && array_key_exists('value', $value))
			{
				$setting[$value['key']] = $value['value'];
			}
		}


		if(!isset($setting['ratio']))
		{
			$setting['ratio'] = null;

		}

		$setting['ratio_detail'] = \lib\ratio::product_ratio($setting);



		return $setting;

	}




	public static function telegram_setting()
	{
		$cat   = 'telegram_setting';

		$result = \lib\db\setting\get::by_cat($cat);
		if(!is_array($result))
		{
			$result = [];
		}

		$setting = [];

		foreach ($result as $key => $value)
		{
			if(isset($value['key']) && array_key_exists('value', $value))
			{
				$setting[$value['key']] = $value['value'];
			}
		}


		return $setting;

	}



	public static function order_setting()
	{
		$cat   = 'order_setting';

		$result = \lib\db\setting\get::by_cat($cat);
		if(!is_array($result))
		{
			$result = [];
		}

		$setting = [];

		foreach ($result as $key => $value)
		{
			if(isset($value['key']) && array_key_exists('value', $value))
			{
				$setting[$value['key']] = $value['value'];
			}
		}


		return $setting;

	}



	public static function cart_setting()
	{
		$cat   = 'cart_setting';

		$result = \lib\db\setting\get::by_cat($cat);
		if(!is_array($result))
		{
			$result = [];
		}

		$setting = [];

		foreach ($result as $key => $value)
		{
			if(isset($value['key']) && array_key_exists('value', $value))
			{
				$setting[$value['key']] = $value['value'];
			}
		}

		if(isset($setting['color']))
		{
			$class = null;
			switch ($setting['color'])
			{
				case 'red':
					$class = 'danger2';
					break;

				case 'green':
					$class = 'success2';
					break;
				case 'blue':
					$class = 'primary2';
					break;

				case 'yellow':
					$class = 'warn2';
					break;

				default:
					# code...
					break;
			}

			$setting['color_class'] = $class;
		}


		return $setting;

	}




	public static function shipping_setting()
	{
		$cat   = 'shipping_setting';

		$result = \lib\db\setting\get::by_cat($cat);
		if(!is_array($result))
		{
			$result = [];
		}

		$setting = [];

		foreach ($result as $key => $value)
		{
			if(isset($value['key']) && array_key_exists('value', $value))
			{
				$setting[$value['key']] = $value['value'];
			}
		}

		if(isset($setting['color']))
		{
			$class = null;
			switch ($setting['color'])
			{
				case 'red':
					$class = 'danger2';
					break;

				case 'green':
					$class = 'success2';
					break;
				case 'blue':
					$class = 'primary2';
					break;

				case 'yellow':
					$class = 'warn2';
					break;

				default:
					# code...
					break;
			}

			$setting['color_class'] = $class;
		}


		return $setting;

	}


	public static function bank_payment_setting()
	{
		$cat   = 'bank_payment_setting';

		$result = \lib\db\setting\get::by_cat($cat);
		if(!is_array($result))
		{
			$result = [];
		}

		$bank_payment_setting = [];

		foreach ($result as $key => $value)
		{
			if(isset($value['key']) && array_key_exists('value', $value))
			{
				$bank_payment_setting[$value['key']] = json_decode($value['value'], true);
			}
		}

		return $bank_payment_setting;

	}



}
?>