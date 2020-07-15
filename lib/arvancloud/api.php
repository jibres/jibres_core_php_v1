<?php
namespace lib\arvancloud;


class api
{

	private static $result_raw = [];


	private static function run($_path, $_method, $_param = null, $_body = null, $_option = [])
	{

		// $apikey   = \dash\setting\arvancloud::apikey();
		$apikey = 'Apikey d4e34a14-d007-461e-8488-8eeac9119e1b';

		$language = \dash\language::current() === 'fa' ? 'fa' : 'en';

		$master_url = "https://napi.arvancloud.com/cdn/4.0/domains/%s";

		$url = sprintf($master_url, $_path);

		// set headers
		$header   = [];
		$header[] = 'Content-Type:application/json';
		$header[] = 'Authorization: '. $apikey;
		$header[] = 'Accept-Language: '. $language;


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
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($_body, JSON_UNESCAPED_UNICODE));
		}

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);

		$response = curl_exec($ch);
		$CurlError = curl_error($ch);

		curl_close ($ch);


		if(!$response)
		{
			\dash\notif::error(T_("Can not connect to Domain server!"));

			$insert_log['result'] = 'Jibres: Result curl is false!';

			if($CurlError)
			{
				$insert_log['result'] .= ' CURL Error: '. $CurlError;
			}

			return false;
		}

		if(!is_string($response))
		{
			$insert_log['result'] = 'Jibres: Result curl is not string!';
			return false;
		}

		$result = json_decode($response, true);

		if(!is_array($result))
		{
			$insert_log['result'] = 'Jibres: Can not parse JSON!';
			return false;
		}

		var_dump($result);exit();

		return $result;

	}


	private static function make_error($_code, $_msg)
	{
		\dash\notif::error(T_($_msg), ['code' => $_code]);
	}


	// ---------------------------------------- DOMAIN ---------------------------------------- //
	public static function domain_list()
	{
		return self::run('', 'get');
	}


}
?>