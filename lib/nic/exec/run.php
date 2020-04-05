<?php
namespace lib\nic\exec;


class run
{
	public static function send($_xml)
	{

		if(!self::allow_request())
		{
			return false;
		}

		$_xml = trim($_xml);

		$data          = [];
		$data['xml']   = $_xml;
		$data['token'] = self::curl_token();

		// create a new cURL resource
		$ch = curl_init();

		//FALSE to stop cURL from verifying the peer's certificate
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

		//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20); // 20 time out of nic-broker
		curl_setopt($ch, CURLOPT_TIMEOUT, 20); // 20 time out of nic-broker

		curl_setopt($ch, CURLOPT_POST, false);
		//The URL to fetch.
		curl_setopt($ch, CURLOPT_URL,"https://tunnel.jibres.ir/nic-broker/");

		//The full data to post in a HTTP "POST" operation.
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

		// grab URL and pass it to the browser
		$response = curl_exec($ch);

		$CurlError = curl_error($ch);

		curl_close ($ch);

		if($response && !is_string($response))
		{
			\dash\log::set('IRNIC:CurlErrorResponseIsNotString');
			\dash\notif::error(T_("Result of IRNIC server is not valid!"));
			return false;
		}

		if($response === 'Failed to connect to epp.nic.ir port 443: No route to host:7')
		{
			if(\dash\permission::supervisor())
			{
				if(is_string($response))
				{
					\dash\notif::error($response);
				}
				else
				{
					\dash\notif::error(T_("Nic server is down!"));
				}
			}
			return $response;
		}

		if($response === false)
		{
			// echo Errors
			\dash\log::set('IRNIC:CurlError', ['message' => $CurlError]);
			\dash\notif::error(T_("Can not connect to domain server"));

			// \dash\notif::error(curl_error($ch));
			return false;
		}

		if(mb_strlen($response) > 10000)
		{
			\dash\notif::error(T_("Response of IRNIC server is too large! Please contact to administrator"));
			\dash\log::set('IRNIC:CurlResponseMaxLen', ['responselen' => mb_strlen($response)]);
			return false;
		}

		$md5response = md5($response);

		// با عرض پوزش، سامانه ایرنیک به جهت عملیات روزانه هر شب از ساعت ۲۳:۰۰ لغایت ۳۰ دقیقه بامداد در دسترس نمی‌باشد.
		if($md5response === 'e933b76e159b9875b6af08f8b04cd40f')
		{
			\dash\notif::error(T_("IRNIC server in every day from 23:00 to 00:30 for upgrade process is busy and not respond."));
		}

		// Arvan 504 Time-out
		if($md5response === '5f9bebf23e3d629f2651b895846e155c')
		{
			\dash\notif::error(T_("The waiting time for the domain server response was very long!"));
		}

		return $response;
	}


	private static function allow_request()
	{
		// check time
		$hour = intval(date("Hi"));
		// 0, 120 => 01:20 , 240 => 02:40, 700 => 7:00, 701 => 7:01
		if($hour >= 701)
		{
			return true;
		}

		// check count request
		$count_request = \lib\db\nic_log\get::count_request_in_day(date("Y-m-d"));
		$count_request = intval($count_request);

		if($count_request < 1700)
		{
			return true;
		}

		// @TODO check request type

		\dash\log::set('IRNIC:MaxRequestIn12-7am');

		\dash\notif::warn(T_("Unfortunately, we are currently unable to respond until 7 am due to the fact that we are in the last hours of the night and the number of requests sent to Irnic has increased. While apologizing, please come back after 7 am and repeat your request"));
		return false;
	}


	public static function result_code($_response)
	{
		if(!$_response || !is_object($_response))
		{
			return false;
		}

		$code = null;
		if(isset($_response->response->result))
		{
			foreach ($_response->response->result->attributes() as $key => $value)
			{
				if($key === 'code')
				{
					$value = (array) $value;
					if(isset($value[0]))
					{
						$code = $value[0];
						break;
					}
				}
			}
		}

		return $code;
	}


	public static function server_id($_response)
	{
		if(!$_response || !is_object($_response))
		{
			return false;
		}
		if(isset($_response->response->trID->svTRID))
		{
			$svTRID = (array) $_response->response->trID->svTRID;
			if(isset($svTRID[0]))
			{
				return $svTRID[0];
			}
		}

		return null;
	}


	private static function curl_token()
	{
		return \dash\setting\nic::curl_token();
	}

	public static function token()
	{
		return \dash\setting\nic::token();
	}


	public static function jibres_nic_account()
	{
		return \dash\setting\nic::jibres_nic_account();
	}


	public static function make_tracking_number($_log_id, $_class_name)
	{
		$test  = '';
		$local = '';

		$test  = '';

		if(\dash\url::isLocal())
		{
			$local = 'LOCAL-';
		}

		$class = substr(strrchr($_class_name, "\\"), 1);
		$class = mb_strtoupper(str_replace('_', '-', $class));

		$time = date("Y-m-d-H:i:s");

		$tracking_number = $test;
		$tracking_number .= $local;

		$tracking_number .= 'JIBRES-';
		$tracking_number .= $time;
		$tracking_number .= '-';
		$tracking_number .= $class;
		$tracking_number .= '-';
		$tracking_number .= $_log_id;

		return $tracking_number;
	}



	public static function code_msg($_code)
	{
		if(is_numeric($_code))
		{
			$_code = floatval($_code);
		}

		$msg = null;

		switch ($_code)
		{
			case 2102:
				$msg = T_("Unimplemented option");
				break;

			case 1000:
				$msg = T_("Command completed successfully");
				break;

			case 2005:
				$msg = T_("Parameter value syntax error");
				break;

			case 2302:
				$msg = T_('Object exists');
				break;

			case 2304:
				$msg = T_("Object status prohibits operation");
				break;

			case 2105:
				$msg = T_("Object is not eligible for renewal");
				break;

			case 1301:
				$msg = T_("Command completed successfully; ack to dequeue");
				break;

			case 2303:
				$msg  = T_("Object does not exist");
				break;

			case 2104:
				$msg = T_("Currency type of your contract is different with currency type of the holder.");
				break;

			case 1001:
			case 1300:
			case 1500:
			case 2000:
			case 2001:
			case 2002:
			case 2003:
			case 2004:
			case 2100:
			case 2101:
			case 2103:
			case 2106:
			case 2200:
			case 2201:
			case 2202:
			case 2300:
			case 2301:
			case 2305:
			case 2306:
			case 2307:
			case 2308:
			case 2400:
			case 2500:
			case 2501:
			case 2502:
				$msg = 'Error code '. $_code;
				break;

			default:
				$msg = 'Unknown error '. $_code;
				break;
		}

		return $msg;
	}


}
?>