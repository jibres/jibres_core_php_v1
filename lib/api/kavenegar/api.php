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
	private static function execute($_apikey, $_url, $_data, $_long_time_out = false)
	{
		$headers = array (
			'Accept: application/json',
			'Content-Type: application/x-www-form-urlencoded',
			'charset: utf-8'
		);

		$fields_string = null;
		if(is_array($_data))
		{
			$fields_string = \dash\request::build_query($_data);
		}

		\dash\temp::set('rawKavenegrarSendParam', json_encode($_data, JSON_UNESCAPED_UNICODE));

		// for debug you can uncomment below line to see the send parameters
		if($_long_time_out || true)
		{
			$CONNECTTIMEOUT = 30;
			$TIMEOUT        = 40;

		}
		else
		{
			$CONNECTTIMEOUT = 5;
			$TIMEOUT        = 10;
		}

		//======================================================================================//
		if(!function_exists('curl_init'))
		{
			return false;
		}

		$url = sprintf(self::$api_url, $_apikey, $_url);

		var_dump($url);exit;

		$handle   = curl_init();
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($handle, CURLOPT_POST, true);
		curl_setopt($handle, CURLOPT_POSTFIELDS, $fields_string);

		// add timer to ajax request
		curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, $CONNECTTIMEOUT);
		curl_setopt($handle, CURLOPT_TIMEOUT, $TIMEOUT);

		$response = curl_exec($handle);
		$mycode   = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		// check mycode in special situation, if has default code with status handle it
		curl_close ($handle);
		//=====================================================================================//
		// for debug you can uncomment below line to see the result get from server

		\dash\temp::set('rawKavenegrarResult', $response);

		if(!$response)
		{
			return false;
		}


		$json_data		= json_decode($response, true);

		return $json_data;
	}


	/**
	 * send sms
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function send(array $_args)
	{

		$apikey         = a($_args, 'apikey');

		$mobile         = a($_args, 'mobile');
		$message        = a($_args, 'message');
		$linenumber     = a($_args, 'linenumber');
		$LocalMessageid = a($_args, 'LocalMessageid');
		$date           = a($_args, 'date');

		$type           = a($_args, 'type');

		if(!$type)
		{
			$type = 1;
		}

		$params 	=
		[
			"receptor"       => $mobile,
			"sender"         => $linenumber,
			"message"        => $message,
			"type"           => $type,
			// "date"           => $_date,
			"LocalMessageid" => $LocalMessageid,
		];

		if($date)
		{
			$params['date'] = $date;
		}

		return self::execute($apikey, 'sms', $params);

	}


	/**
	 * send array
	 *
	 * @param      <type>   $_sender    The sender
	 * @param      <type>   $_receptor  The receptor
	 * @param      <type>   $_message   The message
	 * @param      integer  $_type      The type
	 * @param      integer  $_date      The date
	 *
	 * @return     <type>   ( description_of_the_return_value )
	 */
	public function sendarray($_sender, $_receptor, $_message, $_type= 1, $_date= 0)
	{
		$sender         = [];
		$message        = [];
		$type           = [];
		$receptor_count = count($_receptor);

		if(is_array($_sender))
		{
			$sender = $_sender;
		}
		else
		{
			for ($i = 0; $i < $receptor_count; $i++)
			{
				array_push($sender, $_sender);
			}
		}

		if(is_array($_message))
		{
			$message = $_message;
		}
		else
		{
			for ($i = 0; $i < $receptor_count; $i++)
			{
				array_push($message, $_message);
			}
		}

		if(is_array($_type))
		{
			$type 	= $_type;
		}
		else
		{
			for ($i = 0; $i < $receptor_count; $i++)
			{
				array_push($type, $_type);
			}
		}

		$path 		= $this->get_path(__FUNCTION__);
		$params 	=
		[
			"receptor" => json_encode($_receptor),
			"sender"   => json_encode($sender),
			"message"  => json_encode($message),
			"type"     => json_encode($type),
			"date"     => $_date,
		];

		$json = $this->execute($path, $params);

		if(!is_array($json))
		{
			return $this->status;
		}

		return $json;
	}



	/**
	 * lookup verification code
	 *
	 * @param      <type>  $_receptor  The receptor
	 * @param      <type>  $_token     The token
	 * @param      <type>  $_token2    The token 2
	 * @param      <type>  $_token3    The token 3
	 * @param      <type>  $_template  The template
	 * @param      string  $_type      The type
	 */
	public function verify($_mobile, $_token, $_token2 = null, $_token3 = null, $_token10 = null, $_token20 = null, $_template = null, $_type = 'sms')
	{

		$path = $this->get_path('lookup','verify');
		$parameters =
		[
			'receptor' => $_mobile,
			'token'    => $_token,
			'template' => $_template,

		];

		if(!is_null($_type)) $parameters['token2']     = $_type;
		if(!is_null($_token2)) $parameters['token2']   = $_token2;
		if(!is_null($_token3)) $parameters['token3']   = $_token3;
		if(!is_null($_token10)) $parameters['token10'] = $_token10;
		if(!is_null($_token20)) $parameters['token20'] = $_token20;

		$json = $this->execute($path, $parameters);

		if(!is_array($json))
		{
			return $this->status;
		}

		return $json;
	}

	public function tts($_mobile, $_message)
	{

		$path = $this->get_path('maketts','call');
		$parameters =
		[
			'receptor' => $_mobile,
			'message'  => $_message,
			'date'     => null,
			'localid'  => null,
			'repeat'   => null,

		];


		$json = $this->execute($path, $parameters);

		if(!is_array($json))
		{
			return $this->status;
		}

		return $json;
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