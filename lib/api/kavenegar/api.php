<?php
namespace lib\api\kavenegar;


class api
{

	private static $api_url = "https://api.kavenegar.com/v1/%s/%s/%s.json";
	private static $apikey  = null;



	/**
	 * curl to kavenagar
	 *
	 * @param      <type>   $_url   The url
	 * @param      <type>   $_data  The data
	 *
	 * @return     integer  ( description_of_the_return_value )
	 */
	private static function execute($_apikey, $_module, $_method, $_data = [])
	{
		if(!function_exists('curl_init'))
		{
			return false;
		}

		$headers =
		[
			'Accept: application/json',
			'Content-Type: application/x-www-form-urlencoded',
			'charset: utf-8'
		];

		$post_field = null;
		if(is_array($_data))
		{
			$post_field = \dash\request::build_query($_data);
		}

		$url = sprintf(self::$api_url, $_apikey, $_module, $_method);

		$handle   = curl_init();
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($handle, CURLOPT_POST, true);
		curl_setopt($handle, CURLOPT_POSTFIELDS, $post_field);
		curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($handle, CURLOPT_TIMEOUT, 40);

		$response = curl_exec($handle);
		$mycode   = curl_getinfo($handle, CURLINFO_HTTP_CODE);

		curl_close ($handle);

		if(!$response)
		{
			return false;
		}

		$json_data		= json_decode($response, true);

		return $json_data;
	}


	private static function detect_api_key($_option)
	{
		if(a($_option, 'apikey'))
		{
			return $_option['apikey'];
		}
		else
		{
			return \dash\setting\kavenegar::apikey(a($_option, 'business_mode'));
		}
	}



	private static function detect_line_number($_option)
	{
		if(a($_option, 'linenumber'))
		{
			return $_option['linenumber'];
		}
		else
		{
			return \dash\setting\kavenegar::line(a($_option, 'business_mode'));
		}
	}


	public static function send_tts($_mobile, $_message, $_option = [])
	{

		$apikey = self::detect_api_key($_option);


		$localid = a($_option, 'localid');

		$params 	=
		[
			"receptor" => $_mobile,
			"message"  => $_message,
			// "date"  => null,
			"localid"  => $localid,
		];

		return self::execute($apikey, 'call', 'maketts', $params);
	}

	/**
	 * send sms
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function send($_mobile, $_message, $_option = [])
	{
		$apikey = self::detect_api_key($_option);

		$linenumber = self::detect_line_number($_option);

		$localid = a($_option, 'localid');


		$localid    = a($_option, 'localid');
		$date       = a($_option, 'date');

		$type       = a($_option, 'type');

		if(!$type)
		{
			$type = 1;
		}

		$params 	=
		[
			"receptor" => $_mobile,
			"message"  => $_message,
			"type"     => $type,
			"localid"  => $localid,
		];

		if($linenumber)
		{
			$params['sender'] = $linenumber;
		}

		if($date)
		{
			$params['date'] = $date;
		}

		return self::execute($apikey, 'sms', 'send', $params);

	}


	/**
	 * send sms
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function verification($_mobile, $_template, $_token, $_option = [])
	{
		$apikey = self::detect_api_key($_option);


		$params =
		[
			"receptor" => $_mobile,
			"template" => $_template,
			"token"    => $_token,
		];


		if(a($_option, 'token2'))
		{
			$params['token2'] = $_option['token2'];
		}

		if(a($_option, 'token3'))
		{
			$params['token3'] = $_option['token3'];
		}

		if(a($_option, 'type'))
		{
			$params['type'] = $_option['type'];
		}

		return self::execute($apikey, 'verify', 'lookup', $params);

	}





	public function msg($_code)
	{
		$msg = null;
		switch ($_code)
		{
			case 200: $msg = 'درخواست تایید شد'; break;
			case 400: $msg = 'پارامترها ناقص هستند'; break;
			case 401: $msg = 'حساب کاربری غیرفعال شده است'; break;
			case 402: $msg = 'عملیات ناموفق بود'; break;
			case 403: $msg = 'کد شناسائی ( API KEY ) یا اطلاعات ورود (نام کاربری و رمز عبور ) معتبر نمی‌باشد.'; break;
			case 409: $msg = 'سرور قادر به پاسخگوئی نیست بعدا تلاش کنید'; break;
			case 411: $msg = 'دریافت کننده نامعتبر است'; break;
			case 412: $msg = 'ارسال کننده نامعتبر است'; break;
			case 413: $msg = 'پیام خالی است و یا طول پیام بیش از حد مجاز می‌باشد. لاتین 612 ﻛﺎراﻛﺘﺮ و ﻓﺎرﺳﻲ 268 ﻛﺎراﻛﺘﺮ'; break;
			case 414: $msg = 'تعداد رکورد ها بیشتر از حد مجاز است . در هر فراخوانی حداکثر 200 رکورد .'; break;
			case 417: $msg = 'تاریخ معتبر نمی‌باشد. مقدار 0 به معنای زمانی فعلی است و در غیر اینصورت فرمتUNIXTIME'; break;
			case 418: $msg = 'اعتبار حساب شما کافی نیست. لطفا برای شارژ حساب اقدام نمائید.'; break;
			case 419: $msg = 'طول آرایه متن و گیرنده ها و فرستنده ها هم اندازه نیست .'; break;
			case 502: $msg = 'نام کاربری انتخاب شده تکراری می‌باشد.'; break;
			case 503: $msg = 'شناسه داخلی انتخاب شده تکراری است (localid)'; break;
			case 504: $msg = 'تعرفه ارسال پیامک ارزان تر از تعرفه والد می‌باشد.'; break;
			case 505: $msg = 'سرویس والد منقضی شده است.(در صورتی مدت سرویس ویژه شما به اتمام رسیده باشد با این خطا روبرو خواهید شد)'; break;
			case 506: $msg = 'تغییر تعرفه در صورتی مانده اعتبار کمتر از 1000 ریال باشد امکان پذیر است.'; break;
		}

		return $msg;
	}
}
?>