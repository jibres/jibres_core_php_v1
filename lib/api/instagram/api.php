<?php
namespace lib\api\instagram;

class api
{

	private static $api_url    = 'https://api.instagram.com';
	private static $graph_url  = 'https://graph.instagram.com';

	// only for graph url
	private static $version    = 'v12.0';

	private static $result_raw = [];


	private static function app_id()
	{
		return '887342455486578';
	}


	private static function app_secret()
	{
		return '6b8920f3c83407cae4e48a234d457d99';
	}


	private static function redirect_uri()
	{
		return 'https://jibres.ir/hook/ig/';
	}


	private static function run($_args)
	{

		if(a($_args, 'api_mode') === 'api')
		{
			$master_url = self::$api_url;
		}
		else
		{
			$master_url = self::$graph_url;
			$master_url .= '/'. self::$version;
		}

		$param = [];
		if(is_array(a($_args, 'param')))
		{
			$param = $_args['param'];
		}

		$body = [];
		if(is_array(a($_args, 'body')))
		{
			$body = $_args['body'];
		}

		$method = 'get';
		if(a($_args, 'method'))
		{
			$method = $_args['method'];
		}

		$url = $master_url;

		if($param)
		{
			$url .= '?'. http_build_query($param);
		}

		// set headers
		$header   = [];
		$header[] = 'Accept: application/json';

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, mb_strtoupper($method));
		curl_setopt($ch, CURLOPT_URL, $url);

		if($body && is_array($body))
		{
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
		}


		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);

		$response  = curl_exec($ch);
		$CurlError = curl_error($ch);
		$getInfo   = curl_getinfo($ch);
		curl_close ($ch);

		var_dump($response, $CurlError, $getInfo);exit;

		$log =
		[
			'url'             => $url,
			'func_get_args'   => func_get_args(),
			'response'        => $response,
			'response_decode' => json_decode($response, true),
			'CurlError'       => $CurlError,
		];

		// \dash\log::file(json_encode($log, JSON_UNESCAPED_UNICODE), 'arvan_cdn_api.log', 'arvand_api');

		if(!$response)
		{
			\dash\notif::error(T_("Can not connect to Domain server!"));

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
			return addslashes($response);
		}

		return $result;

	}



	public static function getLoginUrl($_state = null)
	{
		$param =
		[
			'client_id'     => self::app_id(),
			'redirect_uri'  => self::redirect_uri(),
			'scope'         => implode(',', ['user_profile','public_content','user_media','user_photos','basic','likes','comments']),
			'response_type' => 'code',
		];

		if($_state)
		{
			$param['state'] = $_state;
		}

		$url = self::$api_url;
		$url .= '/oauth/authorize';

		$url .= '?'. http_build_query($param);

		return $url;

	}






}
?>