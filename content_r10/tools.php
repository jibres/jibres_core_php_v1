<?php
namespace content_r10;


class tools
{
	public static $r10             = [];
	private static $REQUEST       = [];
	private static $request_check = false;

	/**
	 * this function route as first of every request on api
	 */
	public static function master_check()
	{
		self::check_appkey();
		self::check_apikey();

		// never store init in r10
		self::check_store_not_init();
	}


	public static function appkey_required()
	{
		if(isset(self::$r10['appkey_detail']) && self::$r10['appkey_detail'])
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


	private static function check_store_not_init()
	{
		if(\dash\url::store())
		{
			self::stop(403, T_("Can not set store in url"));
			return false;
		}

		// if(\lib\store::id())
		// {
		// 	self::stop(403, T_("Can not set store in url"));
		// }
	}


	/**
	 * Load appkey from header
	 * IF exists
	 * Check require in another function
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
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

		$appkey_is_ok              = \dash\app\user_auth::check_appkey($appkey);

		self::$r10['appkey_detail'] = $appkey_is_ok;

		if($appkey_is_ok)
		{
			return true;
		}
		else
		{
			self::stop(400, T_("Invalid app key"));
		}
	}



	/**
	 * Get api key from header
	 * if exists
	 * Check required in another function
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
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

		$session_id = \dash\url::root(). 'APICORE'. $get['id'];

		\dash\engine\prepare::session_api_start($session_id);

		if(!\dash\user::id())
		{
			\dash\user::init($get['user_id']);
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