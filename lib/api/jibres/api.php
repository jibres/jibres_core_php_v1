<?php
namespace lib\api\jibres;

/**
 * Jibres API
 * This class describes a jibres_api.
 * Execute module content_r10/jibres/plugin
 */
class api
{

	private static function run($_path, $_method, $_param = null, $_body = null, $_option = [])
	{
		if(!\dash\user::login())
		{
			// \dash\notif::error_once(T_("Please login to continue"));
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

		if(\dash\url::isLocal())
		{
			// $url = 'https://core.jibres.ir/r10/jibres/';
			$url = 'https://core.jibres.local/fa/r10/jibres/';
		}
		else
		{
			$url = \dash\url::jibres_subdomain('core');
			// $url .= \dash\language::current(). '/';
			$url .= 'r10/jibres/';
		}


		$url .= $_path;

		// set headers
		$header   = [];
		$header[] = 'Authorization: '. $apikey;
		$header[] = 'x-busisness: '. \lib\store::code();
		$header[] = 'x-buser: '. \dash\user::code();
		$header[] = 'x-juser: '. \dash\coding::encode(\dash\user::jibres_user());

		if($_body)
		{
			$header[] = 'Accept: application/json';
			$header[] = 'Content-Type: application/json';
		}


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
			$_body = json_encode($_body);
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
			'Info'            => $getInfo,
		];

		// \dash\log::file(json_encode($log, JSON_UNESCAPED_UNICODE), 'jibres_api.log', 'jibres_api');

		if(!$response)
		{
			if($CurlError)
			{
				\dash\log::to_supervisor('#jibres_api #CURL_Error: '. $CurlError);
				\dash\log::oops();
			}
			return false;
		}

		if(!is_string($response))
		{
			\dash\notif::error('Jibres: Invalid result!');
			return false;
		}

		$result = json_decode($response, true);

		if(!is_array($result))
		{
			if(\dash\url::isLocal())
			{
				var_dump($log);exit;
			}
			else
			{
				\dash\log::file(json_encode($log, JSON_UNESCAPED_UNICODE), 'jibres_api.log', 'jibres_api');
			}

			\dash\notif::error('Jibres: Can not parse JSON!');
			return false;
		}

		\dash\notif::generate_jibres_api_notif($result);

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


	public static function plugin_activate($_args)
	{
		$result = self::run('plugin','post', null, $_args);
		return $result;
	}


	public static function sync_plugin()
	{
		$result = self::run('plugin/sync','get');
		return $result;
	}


	public static function get_instagram_login_url()
	{
		$result = self::run('instagram/login','get');
		return $result;
	}


	public static function get_instagram_media_list($_args)
	{
		$result = self::run('instagram/fetch','get', $_args);
		return $result;
	}



	public static function get_twitter_tweet_list($_args)
	{
		$result = self::run('twitter/fetch','get', $_args);
		return $result;
	}

	public static function lookup_tweet($_args)
	{
		$result = self::run('twitter/lookup','get', $_args);
		return $result;
	}

}
?>