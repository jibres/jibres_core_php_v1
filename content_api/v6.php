<?php
namespace content_api;


class v6
{
	public static $v6 = [];


	public static function master_check()
	{
		$subdomain = \dash\url::subdomain();

		if(!in_array($subdomain, ['source', 'store', null]))
		{
			\dash\header::status(404, T_("Invalid api subdomain. remove subdomain to continue"));
		}
	}


	public static function check_store_init()
	{
		$store = \dash\header::get('store');
		if(!$store || is_numeric($store))
		{
			\content_api\v6::stop(404, T_("Store variable not set in header"));
		}

		\lib\store::set_store_slug($store);

		if(!\lib\store::id())
		{
			\content_api\v6::stop(404, T_("Store not found"));
		}
	}




	public static function check_appkey()
	{
		$appkey = \dash\header::get('appkey');

		\dash\app\apilog::static_var('appkey', $appkey);

		if(!trim($appkey))
		{
			self::stop(400, T_("Appkey not set"));
		}

		$appkey_is_ok              = \dash\app\user_auth::check_appkey($appkey);

		self::$v6['appkey_detail'] = $appkey_is_ok;

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

		\dash\app\apilog::static_var('token', $token);

		if(!$token)
		{
			self::stop(401, T_("token not set"));
		}

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

		\dash\app\apilog::static_var('apikey', $apikey);

		if(!$apikey)
		{
			self::stop(401, T_("apikey not set"));
		}

		if(mb_strlen($apikey) !== 32)
		{
			self::stop(401, T_("Invalid apikey"));
		}

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

		self::api_user_login($get['id']);

		if(!\dash\user::id())
		{
			\dash\user::init($get['user_id']);
		}

		return true;
	}


	private static function api_user_login($_id)
	{
		$session_id = \dash\url::root(). 'API'. $_id;

		// if a session is currently opened, close it
		if(session_id() != '')
		{
			session_write_close();
		}

		// use new id
		session_id($session_id);
		// start new session
		session_start();
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
}
?>