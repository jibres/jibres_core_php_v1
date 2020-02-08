<?php
namespace lib\nic\exec;


class run
{
	public static function send($_xml)
	{

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

		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 7); // 7 time out of nic-broker
		curl_setopt($ch, CURLOPT_TIMEOUT, 7); // 7 time out of nic-broker

		curl_setopt($ch, CURLOPT_POST, false);
		//The URL to fetch.
		curl_setopt($ch, CURLOPT_URL,"https://tunnel.jibres.ir/nic-broker/");

		//The full data to post in a HTTP "POST" operation.
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

		// grab URL and pass it to the browser
		$response = curl_exec($ch);

		if($response === false)	{
			// echo Errors
			\dash\log::set('IRNIC:CurlError', ['message' => curl_error($ch)]);
			// \dash\notif::error(curl_error($ch));
			return false;
		}
		// close cURL resource, and free up system resources
		curl_close ($ch);

		return $response;
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

			case 1001:
			case 1300:
			case 1301:
			case 1500:
			case 2000:
			case 2001:
			case 2002:
			case 2003:
			case 2004:
			case 2005:
			case 2100:
			case 2101:
			case 2103:
			case 2104:
			case 2105:
			case 2106:
			case 2200:
			case 2201:
			case 2202:
			case 2300:
			case 2301:
			case 2302:
			case 2303:
			case 2304:
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