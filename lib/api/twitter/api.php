<?php
namespace lib\api\twitter;

class api
{

	private static $api_url    = 'https://api.twitter.com/2/';

	private static $result_raw = [];

	private static $load_setting = [];


	private static function config()
	{
		if(!self::$load_setting)
		{
			$account = 'jibres.com';
			self::$load_setting = \dash\setting\whisper::say('twitter', $account);
		}
	}


	public static function access_token()
	{
		self::config();
		return a(self::$load_setting, 'access_token');
	}

	public static function access_token_secret()
	{
		self::config();
		return a(self::$load_setting, 'access_token_secret');
	}

	public static function api_key()
	{
		self::config();
		return a(self::$load_setting, 'api_key');
	}

	public static function apikey_secret()
	{
		self::config();
		return a(self::$load_setting, 'apikey_secret');
	}

	public static function bearer()
	{
		self::config();
		return a(self::$load_setting, 'bearer');
	}

	private static function app_id()
	{
		self::config();
		return a(self::$load_setting, 'app_id');
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


		$master_url = self::$api_url;

		if(a($_args, 'url'))
		{
			$master_url .= $_args['url'];
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

		if(a($_args, 'bearer'))
		{
			$header[] = "Authorization: Bearer ". self::bearer();
		}

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

		\dash\log::file(json_encode($log, JSON_UNESCAPED_UNICODE), 'twitter.log', 'twitter');

		if(!$response)
		{
			\dash\notif::error(T_("Can not connect to twitter server!"));

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




	/**
	 * Not working yet!
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function timelines_by_username($_username, $_args)
	{
		$result = [];

		$args =
		[
			'method' => 'get',
			'url'    => 'users/by/username/'. $_username,
			'bearer' => true,
			'param'  =>
			[
			],
		];

		$user_detail =  self::run($args);

		if(isset($user_detail['data']['id']))
		{
			$twitter_id = $user_detail['data']['id'];

			$args =
			[
				'method' => 'get',
				'url'    => 'users/'.$twitter_id.'/tweets',
				'bearer' => true,
				'param'  =>
				[
				],
			];

			$result =  self::run($args);


		}
		return $result;
	}

}
?>