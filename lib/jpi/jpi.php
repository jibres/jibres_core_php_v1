<?php
namespace lib\jpi;


class jpi
{

	private static $result_raw = [];


	private static function run($_path, $_method, $_param = null, $_body = null, $_option = [])
	{
		if(!\dash\user::login())
		{
			return false;
		}

		if(!\dash\engine\store::inStore())
		{
			\dash\notif::error_once(T_("This method works only in business mode"));
			return false;
		}

		$jibres_user_id = \dash\user::detail('jibres_user_id');

		if(!$jibres_user_id)
		{
			\dash\notif::error_once(T_("Please login to continue"));
			return false;
		}


		$apikey = \dash\setting\whisper::say('jibres_api', 'token');

		$apikey = \dash\utility::hasher($apikey);

		$url = \dash\url::jibres_subdomain('core');
		$url .= \dash\language::current(). '/';
		$url .= 'r10/jpi/';
		$url .= $_path;

		// set headers
		$header   = [];
		$header[] = 'Authorization: '. $apikey;
		$header[] = 'x-busisness: '. \lib\store::code();
		$header[] = 'x-buser: '. \dash\user::code();
		$header[] = 'x-juser: '. \dash\coding::encode(\dash\user::jibres_user());


		if($_param && is_array($_param))
		{
			$url .= '?'. http_build_query($_param);
		}

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, mb_strtoupper($_method));
		curl_setopt($ch, CURLOPT_URL, $url);

		if($_body && is_array($_body))
		{
			$_body = json_encode($_body, JSON_UNESCAPED_UNICODE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $_body);
		}


		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);

		$response  = curl_exec($ch);
		$CurlError = curl_error($ch);
		$getInfo   = curl_getinfo($ch);
		curl_close ($ch);

		$log =
		[
			'header'          => $header,
			'url'             => $url,
			'func_get_args'   => func_get_args(),
			'response'        => $response,
			'response_decode' => json_decode($response, true),
			'CurlError'       => $CurlError,
			'Info'       => $getInfo,
		];

		// var_dump($log);exit;
		// \dash\log::file(json_encode($log, JSON_UNESCAPED_UNICODE), 'arvan_cdn_api.log', 'arvand_api');

		if(!$response)
		{
			if($CurlError)
			{
				\dash\notif::error(' CURL Error: '. $CurlError);
			}
			return false;
		}

		if(!is_string($response))
		{
			\dash\notif::error('Jibres: Result curl is not string!');
			return false;
		}

		$result = json_decode($response, true);

		if(!is_array($result))
		{
			\dash\notif::error('Jibres: Can not parse JSON!');
			return false;
		}

		return $result;

	}



	public static function budget()
	{
		$result = self::run('budget','get');

		if(isset($result['result']))
		{
			return $result['result'];
		}

		return false;
	}





}
?>