<?php
namespace dash\utility\pay;


class get
{
	public static function config()
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
	/**
	 * Sets the payment setting.
	 * Call in content_pay/home/view
	 */
	public static function set_payment_setting()
	{
		$payment_list                 = [];

		$payment_list['parsian']      = \dash\setting\parsian::get();
		$payment_list['asanpardakht'] = \dash\setting\asanpardakht::get();
		$payment_list['irkish']       = \dash\setting\irkish::get();
		$payment_list['zarinpal']     = \dash\setting\zarinpal::get();
		$payment_list['payir']        = \dash\setting\payir::get();
		$payment_list['mellat']       = \dash\setting\mellat::get();
		$payment_list['sep']          = \dash\setting\sep::get();
		$payment_list['idpay']        = \dash\setting\idpay::get();
		$payment_list['payping']      = \dash\setting\payping::get();
		$payment_list['nextpay']      = \dash\setting\nextpay::get();

		$default = null;
		$count_active = 0;

		foreach ($payment_list as $key => $value)
		{
			if(a($value, 'status'))
			{
				$count_active++;
				$default = $key;
			}
		}

		if($count_active > 1)
		{
			$default = null;
		}

		return
		[
			'list'         => $payment_list,
			'count_active' => $count_active,
			'default'      => $default,
		];



	}


	public static function list()
	{
		$payment                 = [];
		$payment['parsian']      = ['title' => T_('Parsian Payment'), 				'key' => 'parsian', 'icon' => \dash\url::cdn(). '/img/thirdparty/bank/parsian.png'];
		$payment['asanpardakht'] = ['title' => T_('Asanpardakht payment'), 			'key' => 'asanpardakht', 'icon' => \dash\url::cdn(). '/img/thirdparty/bank/asanpardasht-logo.svg'];
		$payment['irkish']       = ['title' => T_('IranKish Payment'), 				'key' => 'irkish', 'icon' => \dash\url::cdn(). '/img/thirdparty/bank/irkish.jpg'];
		$payment['zarinpal']     = ['title' => T_('Zarinpal payment'), 				'key' => 'zarinpal', 'icon' => \dash\url::cdn(). '/img/thirdparty/bank/zarinpal-icon.svg'];
		$payment['payir']        = ['title' => T_('Payir Payment'), 				'key' => 'payir', 'icon' => \dash\url::cdn(). '/img/thirdparty/bank/payir.png'];
		$payment['mellat']       = ['title' => T_('Mellat payment'), 				'key' => 'mellat', 'icon' => \dash\url::cdn(). '/img/thirdparty/bank/mellat-logo.svg'];
		$payment['sep']          = ['title' => T_('Sep payment'), 					'key' => 'sep', 'icon' => \dash\url::cdn(). '/img/thirdparty/bank/parsian.png'];
		$payment['idpay']        = ['title' => T_('IDPay payment'), 				'key' => 'idpay', 'icon' => \dash\url::cdn(). '/img/thirdparty/bank/idpay-icon.png'];
		$payment['nextpay']        = ['title' => T_('NextPay'), 					'key' => 'nextpay', 'icon' => \dash\url::cdn(). '/img/thirdparty/bank/nextpay.png'];

		return $payment;

	}


	public static function active_payment()
	{
		self::config();

		$payment                 = [];
		$payment['parsian']      = \dash\setting\parsian::get();
		$payment['asanpardakht'] = \dash\setting\asanpardakht::get();
		$payment['irkish']       = \dash\setting\irkish::get();
		$payment['zarinpal']     = \dash\setting\zarinpal::get();
		$payment['payir']        = \dash\setting\payir::get();
		$payment['mellat']       = \dash\setting\mellat::get();
		$payment['sep']          = \dash\setting\sep::get();
		$payment['idpay']        = \dash\setting\idpay::get();
		$payment['nextpay']      = \dash\setting\nextpay::get();

		$detail = self::list();

		$result = [];

		foreach ($payment as $key => $value)
		{
			if(a($value, 'status'))
			{
				$value['title'] = a($detail, $key, 'title');
				$value['key']   = a($detail, $key, 'key');
				$value['icon']  = a($detail, $key, 'icon');
				$result[]       = $value;
			}
		}

		return $result;

	}
}
?>
