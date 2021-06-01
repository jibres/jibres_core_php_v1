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
		\dash\data::myPayment_parsian(\dash\setting\parsian::get());
		\dash\data::myPayment_asanpardakht(\dash\setting\asanpardakht::get());
		\dash\data::myPayment_irkish(\dash\setting\irkish::get());
		\dash\data::myPayment_zarinpal(\dash\setting\zarinpal::get());
		\dash\data::myPayment_payir(\dash\setting\payir::get());
		\dash\data::myPayment_mellat(\dash\setting\mellat::get());
		\dash\data::myPayment_sep(\dash\setting\sep::get());
		\dash\data::myPayment_idpay(\dash\setting\idpay::get());

	}


	public static function list()
	{
		$payment                 = [];
		$payment['parsian']      = ['title' => T_('Parsian Payment'), 				'key' => 'parsian'];
		$payment['asanpardakht'] = ['title' => T_('Asanpardakht payment'), 			'key' => 'asanpardakht'];
		$payment['irkish']       = ['title' => T_('IranKish Payment'), 				'key' => 'irkish'];
		$payment['zarinpal']     = ['title' => T_('Zarinpal payment'), 				'key' => 'zarinpal'];
		$payment['payir']        = ['title' => T_('Payir Payment'), 				'key' => 'payir'];
		$payment['mellat']       = ['title' => T_('Mellat payment'), 				'key' => 'mellat'];
		$payment['sep']          = ['title' => T_('Sep payment'), 					'key' => 'sep'];
		$payment['idpay']        = ['title' => T_('IDPay payment'), 				'key' => 'idpay'];

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

		$detail = self::list();

		$result = [];

		foreach ($payment as $key => $value)
		{
			if(a($value, 'status'))
			{
				$value['title'] = a($detail, $key, 'title');
				$value['key']   = a($detail, $key, 'key');
				$result[]       = $value;
			}
		}

		return $result;

	}
}
?>
