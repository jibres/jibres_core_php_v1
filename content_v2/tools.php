<?php
namespace content_v2;


class tools
{
	public static $v2             = [];
	private static $REQUEST       = [];
	private static $request_check = false;

	/**
	 * this function route as first of every request on api
	 */
	public static function master_check()
	{
		self::check_appkey();
		self::check_apikey();
	}


	public static function appkey_required()
	{
		if(isset(self::$v2['appkey_detail']) && self::$v2['appkey_detail'])
		{
			return true;
		}
		else
		{
			self::stop(403, T_("Appkey not set"));
		}
	}


	public static function apikey_required()
	{
		if(!\dash\user::id())
		{
			self::stop(403, T_("Apikey not set"));
		}
	}


	public static function check_appkey()
	{
		$appkey = \dash\header::get('appkey');

		$appkey = \dash\validate::md5($appkey);

		if(!$appkey)
		{
			return;
		}

		\dash\app\apilog::static_var('appkey', $appkey);

		if(!trim($appkey))
		{
			self::stop(400, T_("Appkey not set"));
		}

		$appkey_is_ok              = \dash\app\user_auth::jibres_check_appkey($appkey);

		self::$v2['appkey_detail'] = $appkey_is_ok;

		if($appkey_is_ok)
		{
			return true;
		}
		else
		{
			self::stop(400, T_("Invalid app key"));
		}
	}



	public static function check_token()
	{
		$token = \dash\header::get('token');
		$token = \dash\validate::md5($token);

		if(!$token)
		{
			self::stop(401, T_("token not set"));
		}

		\dash\app\apilog::static_var('token', $token);

		if(!$token || mb_strlen($token) !== 32)
		{
			self::stop(401, T_("Invalid token"));
		}

		$get =
		[
			'status'  => 'enable',
			'user_id' => null,
			'type'    => 'guest',
			'auth'    => $token,
			'limit'   => 1,
		];

		$get = \dash\db\user_auth::get($get);

		if(!isset($get['id']) || !isset($get['datecreated']))
		{
			self::stop(401, T_("Invalid token"));
		}

		$time_left = time() - strtotime($get['datecreated']);

		$life_time = 60 * 3;

		if($time_left > $life_time)
		{
			\dash\db\user_auth::update(['status' => 'expire'], $get['id']);
			self::stop(401, T_("Token is expire"));
		}

		\dash\db\user_auth::update(['status' => 'used'], $get['id']);

		return true;
	}


	public static function check_apikey()
	{
		$apikey = \dash\header::get('apikey');
		$apikey = \dash\validate::md5($apikey);

		if(!$apikey)
		{
			return false;
		}

		\dash\app\apilog::static_var('apikey', $apikey);

		$get =
		[
			'status'  => 'enable',
			'user_id' => [" IS ", " NOT NULL "],
			'type'    => 'member',
			'auth'    => $apikey,
			'limit'   => 1,
		];

		$get = \dash\db\user_auth::get($get);

		if(!isset($get['id']) || !isset($get['datecreated']) || !isset($get['user_id']))
		{
			self::stop(401, T_("Invalid apikey"));
		}

		// need to get store in session name
		// if not. every user by unit auth id can be login togheder in another store!!!
		// the url::kingdom have store code and subdomain
		$session_id = \dash\url::kingdom(). 'APIV2'. $get['id'];
		$session_id = 'APIV2-'. md5($session_id);

		\dash\session::restart($session_id);

		if(!\dash\user::id())
		{
			\dash\user::store_init($get['user_id'], true);
		}

		return true;
	}


	public static function invalid_url()
	{
		self::stop(404, T_("Invalid url"));
	}


	public static function invalid_method()
	{
		self::stop(405, T_("Invalid method"));
	}


	public static function invalid_param($_param = null)
	{
		self::stop(400, T_("Invalid param :val", ['val' => $_param]));
	}





	public static function stop($_code, $_msg = null, $_result = null)
	{
		\dash\header::set($_code);

		if(in_array(intval($_code), [400,401,403,404,429,405,415]) && \dash\engine\process::status())
		{
			\dash\engine\process::stop();
		}

		if($_msg)
		{
			\dash\notif::error($_msg);
		}
		self::say($_result);
	}


	public static function say($_result = null)
	{
		\dash\app\apilog::save($_result);
		\dash\notif::api($_result);
	}


	public static function input_body($_name = null)
	{
		if(!self::$request_check)
		{
			self::$request_check = true;

			if(\dash\request::post())
			{
				\dash\notif::warn(T_("Send your request as json not in post field"));
			}

			$request = \dash\request::php_input();
			if(is_string($request))
			{
				$request = json_decode($request, true);
			}

			if(!is_array($request))
			{
				$request = [];
			}

			$request = \dash\safe::safe($request, 'sqlinjection');

			self::$REQUEST = $request;
		}

		if(isset($_name))
		{
			if(array_key_exists($_name, self::$REQUEST))
			{
				return self::$REQUEST[$_name];
			}
			else
			{
				return null;
			}
		}
		else
		{
			return self::$REQUEST;
		}
	}


	public static function isset_input_body($_name)
	{
		self::input_body();

		if(array_key_exists($_name, self::$REQUEST))
		{
			return true;
		}
		return false;
	}
}
?>