<?php
namespace content_a\setting\payment\bank;


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

		if(\dash\request::post('zarinpal'))
		{
			$payment['zarinpal']['status']      = true;
			$payment['zarinpal']['MerchantID']  = \dash\request::post('zMerchantID');
			$payment['zarinpal']['Description'] = \dash\request::post('zDescription');
		}
		else
		{
			$payment['zarinpal']['status']      = false;
		}

		if(\dash\request::post('asanpardakht'))
		{
			$payment['asanpardakht']['status']           = true;
			$payment['asanpardakht']['MerchantID']       = \dash\request::post('aMerchantID');
			$payment['asanpardakht']['MerchantConfigID'] = \dash\request::post('MerchantConfigID');
			$payment['asanpardakht']['Username']         = \dash\request::post('Username');
			$payment['asanpardakht']['Password']         = \dash\request::post('Password');
			$payment['asanpardakht']['EncryptionKey']    = \dash\request::post('EncryptionKey');
			$payment['asanpardakht']['EncryptionVector'] = \dash\request::post('EncryptionVector');
			$payment['asanpardakht']['MerchantName']     = \dash\request::post('MerchantName');

		}
		else
		{
			$payment['asanpardakht']['status']           = false;
		}

		if(\dash\request::post('mellat'))
		{
			$payment['mellat']['status']       = true;
			$payment['mellat']['TerminalId']   = \dash\request::post('TerminalId');
			$payment['mellat']['UserName']     = \dash\request::post('UserName');
			$payment['mellat']['UserPassword'] = \dash\request::post('UserPassword');


		}
		else
		{
			$payment['mellat']['status']           = false;
		}

		if(\dash\request::post('parsian'))
		{
			$payment['parsian']['status']       = true;
			$payment['parsian']['LoginAccount'] = \dash\request::post('LoginAccount');
		}
		else
		{
			$payment['parsian']['status']       = false;
		}

		if(\dash\request::post('payir'))
		{
			$payment['payir']['status'] = true;
			$payment['payir']['api']    = \dash\request::post('api');
		}
		else
		{
			$payment['payir']['status'] = false;
		}

		if(\dash\request::post('irkish'))
		{
			$payment['irkish']['status']      = true;
			$payment['irkish']['merchantId']  = \dash\request::post('imerchantId');
			$payment['irkish']['sha1']        = \dash\request::post('sha1');
			$payment['irkish']['description'] = \dash\request::post('idescription');
		}
		else
		{
			$payment['irkish']['status']      = false;
		}

		return $payment;
	}


	public static function post()
	{
		$post                       = self::getPost();

		\lib\app\setting\set::bank_payment_setting($post);

	}
}
?>
