<?php
namespace lib\api\jibres;

/**
 * Jibres API
 * This class describes a jibres_api.
 */
class api
{

	private static function run($_path, $_method, $_param = null, $_body = null, $_option = [])
	{

		if(a($_option, 'not_check_login'))
		{
			// needless to check login
		}
		else
		{
			if(!\dash\user::login())
			{
				// \dash\notif::error_once(T_("Please login to continue"));
				return false;
			}

			$jibres_user_id = \dash\user::detail('jibres_user_id');

			if(!$jibres_user_id)
			{
				\dash\notif::error_once(T_("Please login to continue"));
				return false;
			}
		}


		if(!\dash\engine\store::inStore())
		{
			\dash\notif::error_once(T_("This method works only in business mode"));
			return false;
		}

		// detect url

		$array_url = [];

		if(\dash\url::isLocal())
		{
			$array_url[] = \dash\url::protocol(). '://core.jibres.local';
			if(\dash\url::lang())
			{
				$array_url[] = \dash\language::current();
			}
		}
		else
		{
			$array_url[] = substr(\dash\url::jibres_subdomain('core'), 0, -1);
		}

		$array_url[] = 'r10';

		$folder = null;

		if(a($_option, 'special_folder'))
		{
			if(is_string(a($_option, 'folder')) && $_option['folder'])
			{
				$folder = $_option['folder'];
			}
		}
		else
		{
			$array_url[] = 'jibres';
		}

		$array_url[] = $_path;

		$array_url = array_filter($array_url);

		$url = implode('/', $array_url);


		$apikey = \dash\setting\whisper::say('jibres_api', 'token');

		$apikey = \dash\utility::hasher($apikey);



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
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($ch, CURLOPT_TIMEOUT, 2);

		$response  = curl_exec($ch);
		$CurlError = curl_error($ch);
		$getInfo   = curl_getinfo($ch);
		curl_close ($ch);

		$log =
		[
			'response'        => $response,
			'header'          => $header,
			'url'             => $url,
			'func_get_args'   => func_get_args(),
			'response_decode' => json_decode($response, true),
			'CurlError'       => $CurlError,
			'Info'            => $getInfo,
		];

		// \dash\log::file(json_encode($log, JSON_UNESCAPED_UNICODE), 'jibres_api.log', 'jibres_api');

		if(!$response)
		{
			if(\dash\url::isLocal())
			{
				var_dump($log);exit();
			}
			\dash\log::file(json_encode($log, JSON_UNESCAPED_UNICODE), 'jibres_api_error.log', 'jibres_api');
			if($CurlError)
			{
				// \dash\log::to_supervisor('#jibres_api #CURL_Error: '. $CurlError);
				// \dash\log::oops();
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


	public static function plan_detail()
	{
		$result = self::run('plan','get', null, null, ['not_check_login' => true]);
		return $result;
	}

    public static function plan_detail_history()
	{
		$result = self::run('plan', 'get', ['gethistory' => true]);
		return $result;
	}


	public static function transaction_list(array $_args)
	{
		$result = self::run('transaction','get', $_args);
		return $result;
	}


	public static function sms_charge_detail()
	{
		$result = self::run('sms_charge', 'get', [], [], ['not_check_login' => true]);
		return $result;
	}

	public static function sms_charge_charge($_args)
	{
		$result = self::run('sms_charge', 'post',  [] , $_args);
		return $result;
	}



	public static function plan_factor(array $_args)
	{
		$_args['factor'] = true;
		$result = self::run('plan', 'get', $_args);
		return $result;

	}

	public static function plan_cancel()
	{
		$result = self::run('plan', 'delete');
		return $result;
	}

	public static function plan_list(array $_args)
	{
		$_args['list'] = true;
		$result = self::run('plan', 'get', $_args);
		return $result;

	}


	public static function sms_charge_list(array $args)
	{
		$_args['list'] = true;
		$result = self::run('sms_charge', 'get', $_args);
		return $result;
	}

	public static function plan_activate($_args)
	{
		$result = self::run('plan','post', null, $_args);
		return $result;
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



	/**
	 * Public api. Get ip detail
	 *
	 * @param      <type>  $_ip    { parameter_description }
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function check_ip($_ip)
	{
		$result = self::run('ip/check','post', [], ['ip' => $_ip], ['not_check_login' => true, 'special_folder' => '']);
		return $result;
	}


	public static function add_store_sms(array $_args)
	{
		$result = self::run('sms','post', [], $_args, ['not_check_login' => true]);
		return $result;
	}


	public static function send_multiple_notif(array $_args)
	{
		$result = self::run('multiplenotif','post', [], $_args, ['not_check_login' => true]);
		return $result;
	}

	public static function fetch_telegram_chat_id(array $_args)
	{
		$result = self::run('telegram','post', [], $_args, ['not_check_login' => true]);
		return $result;
	}




}
