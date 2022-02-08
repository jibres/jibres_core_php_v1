<?php
namespace lib\api\instagram;

class api
{

	private static $api_url    = 'https://api.instagram.com';
	private static $graph_url  = 'https://graph.instagram.com';

	// only for graph url
	private static $version    = 'v12.0';

	private static $result_raw = [];

	private static $load_setting = [];


	private static function config()
	{
		$account = 'reza_test';
		$account = 'jibres_consumer';
		self::$load_setting = \dash\setting\whisper::say('instagram', $account);
	}


	private static function app_id()
	{
		self::config();
		return a(self::$load_setting, 'app_id');
	}


	private static function app_secret()
	{
		self::config();
		return a(self::$load_setting, 'secretkey');
	}


	private static function redirect_uri()
	{
		self::config();
		return a(self::$load_setting, 'redirect_uri');
	}


	/**
	 * Run
	 * Connect to facebook
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	private static function run($_args)
	{

		if(a($_args, 'raw_url'))
		{
			$master_url = $_args['raw_url'];
		}
		else
		{
			$master_url = self::$graph_url;
			$master_url .= '/'. self::$version;
		}

		if(a($_args, 'url'))
		{
			$master_url .= '/'. $_args['url'];
		}

		// get param
		$param = [];
		if(is_array(a($_args, 'param')))
		{
			$param = $_args['param'];
		}

		// body param
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


		$log =
		[
			'url'             => $url,
			'func_get_args'   => func_get_args(),
			'response'        => $response,
			'response_decode' => json_decode($response, true),
			'CurlError'       => $CurlError,
		];

		// var_dump($log);exit;

		// \dash\log::file(json_encode($log, JSON_UNESCAPED_UNICODE), 'arvan_cdn_api.log', 'arvand_api');

		if(!$response)
		{
			\dash\notif::error(T_("Can not connect to Domain server!"));

			if($CurlError)
			{
				// \dash\notif::error(' CURL Error: '. $CurlError);
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
			'scope'         => implode(',', ['user_profile','public_content','user_media','user_photos','basic','likes','comments']),
			'response_type' => 'code',
			'state'         => 1,
			'redirect_uri'  => self::redirect_uri(),
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


	public static function getOAuthToken($_code)
	{
		$args =
		[
			'method' => 'post',
			'raw_url' => self::$api_url. '/oauth/access_token',
			'body' =>
			[
				'client_id'     => self::app_id(),
				'client_secret' => self::app_secret(),
				'grant_type'    => 'authorization_code',
				'redirect_uri'  => self::redirect_uri(),
				'code'          => $_code,
			],
		];

		return self::run($args);
	}



	public static function getUserMedia($_access_token, $_user_id)
	{
		$args =
		[
			'method' => 'get',
			'url'    => $_user_id. '/media',
			'param'  =>
			[
				'fields'     => implode(',', ['caption','id','media_type','media_url','permalink','thumbnail_url','timestamp','username']),
				'access_token' => $_access_token,

			],
		];

		return self::run($args);
	}


	/**
	 * Not working yet!
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function add_post()
	{
		$args =
		[
			'method' => 'post',
			'raw_url' => 'https://graph.facebook.com/17841401959306742/media',
			'param' =>
			[

				'image_url' => 'https://cdn.jibres.ir/img/bg/jibres-privacy-3.jpg',
				'caption' => '#JibresInstagramAPI',

			],
		];

		return self::run($args);
	}

}
?>