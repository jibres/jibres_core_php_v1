<?php
namespace content_a\setting\order\onlinepayment;


class model
{
	public static function getPost()
	{

		$store_payment = \lib\app\setting\get::bank_payment_setting();
		if($store_payment && is_string($store_payment))
		{
			$store_payment = json_decode($store_payment, true);
		}

		if($store_payment && is_array($store_payment))
		{
			$payment = $store_payment;
		}
		else
		{
			$payment                 = [];
			$payment['zarinpal']     = [];
			$payment['asanpardakht'] = [];
			$payment['irkish']       = [];
			$payment['parsian']      = [];
			$payment['payir']        = [];
			$payment['mellat']       = [];
		}

		// zarinpal
		{
			if(\dash\request::post('set_zarinpal_payment_status'))
			{
				$payment['zarinpal']['status']       = \dash\request::post('zarinpal_payment_status');
			}

			if(\dash\request::post('set_zarinpal'))
			{
				$payment['zarinpal']['status']       = \dash\request::get('init') ? true : false;
				$payment['zarinpal']['MerchantID']  = \dash\request::post('zMerchantID');
			}
		}

		// mellat
		{
			if(\dash\request::post('set_mellat_payment_status'))
			{
				$payment['mellat']['status']       = \dash\request::post('mellat_payment_status');
			}

			if(\dash\request::post('set_mellat'))
			{
				$payment['mellat']['status']       = \dash\request::get('init') ? true : false;
				$payment['mellat']['TerminalId']   = \dash\request::post('TerminalId');
				$payment['mellat']['UserName']     = \dash\request::post('UserName');
				$payment['mellat']['UserPassword'] = \dash\request::post('UserPassword');
			}
		}

		// asnapardakht
		{
			if(\dash\request::post('set_asanpardakht_payment_status'))
			{
				$payment['asanpardakht']['status']       = \dash\request::post('asanpardakht_payment_status');
			}

			if(\dash\request::post('set_asanpardakht'))
			{
				$payment['asanpardakht']['status']       = \dash\request::get('init') ? true : false;
				$payment['asanpardakht']['MerchantID']       = \dash\request::post('aMerchantID');
				$payment['asanpardakht']['MerchantConfigID'] = \dash\request::post('MerchantConfigID');
				$payment['asanpardakht']['Username']         = \dash\request::post('Username');
				$payment['asanpardakht']['Password']         = \dash\request::post('Password');
				$payment['asanpardakht']['EncryptionKey']    = \dash\request::post('EncryptionKey');
				$payment['asanpardakht']['EncryptionVector'] = \dash\request::post('EncryptionVector');
				$payment['asanpardakht']['MerchantName']     = \dash\request::post('MerchantName');
			}
		}



		// parsian
		{
			if(\dash\request::post('set_parsian_payment_status'))
			{
				$payment['parsian']['status']       = \dash\request::post('parsian_payment_status');
			}

			if(\dash\request::post('set_parsian'))
			{
				$payment['parsian']['status']       = \dash\request::get('init') ? true : false;
				$payment['parsian']['LoginAccount'] = \dash\request::post('LoginAccount');
			}
		}


		// payir
		{
			if(\dash\request::post('set_payir_payment_status'))
			{
				$payment['payir']['status']       = \dash\request::post('payir_payment_status');
			}

			if(\dash\request::post('set_payir'))
			{
				$payment['payir']['status'] = \dash\request::get('init') ? true : false;
				$payment['payir']['api']    = \dash\request::post('api');
			}
		}


		// idpay
		{
			if(\dash\request::post('set_idpay_payment_status'))
			{
				$payment['idpay']['status']       = \dash\request::post('idpay_payment_status');
			}

			if(\dash\request::post('set_idpay'))
			{
				$payment['idpay']['status'] = \dash\request::get('init') ? true : false;
				$payment['idpay']['apikey'] = \dash\request::post('apikey');
			}
		}




		// idpay
		{
			if(\dash\request::post('set_irkish_payment_status'))
			{
				$payment['irkish']['status']       = \dash\request::post('irkish_payment_status');
			}

			if(\dash\request::post('set_irkish'))
			{
				$payment['irkish']['status'] = \dash\request::get('init') ? true : false;
				$payment['irkish']['merchantId']  = \dash\request::post('imerchantId');
				$payment['irkish']['sha1']        = \dash\request::post('sha1');
			}
		}


		return $payment;
	}


	public static function post()
	{
		if(\dash\request::post('test') === 'payment')
		{
			$meta =
			[
				'msg_go'        => T_("Pay test"),
				'auto_go'       => false,
				'auto_back'     => true,
				'final_msg'     => true,
				'turn_back'     => \dash\url::pwd(),
				'user_id'       => \dash\user::id(),
				'amount'        => 2000,
			];


			$result_pay = \dash\utility\pay\start::api($meta);

			if(isset($result_pay['url']) && isset($result_pay['transaction_id']))
			{
				\dash\redirect::to($result_pay['url']);
			}
			else
			{
				\dash\log::oops('generate_pay_error');
				return false;
			}
			return false;
		}

		$post                       = self::getPost();

		\lib\app\setting\set::bank_payment_setting($post);

		if(\dash\request::post('delete') === 'delete')
		{
			\dash\redirect::to(\dash\url::this(). '/order/onlinepayment');
		}
		else
		{
			\dash\redirect::pwd();
		}

	}
}
?>
