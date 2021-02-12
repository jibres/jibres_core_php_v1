<?php
namespace content_r10;


class tools
{
	public static $r10            = [];

	/**
	 * this function route as first of every request on api
	 */
	public static function master_check()
	{
		if(\dash\url::store())
		{
			self::stop(403, T_("Can not set store in url"));
			return false;
		}

		self::check_appkey();
		self::check_accesstoken();

		if(\dash\url::module() === 'domain')
		{
			self::appkey_required();
			self::accesstoken_required();
		}

		\dash\temp::set('isApi', true);
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


	public static function accesstoken_required()
	{
		if(!\dash\user::id())
		{
			self::stop(403, T_("Access token not set"));
		}
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
	public static function check_accesstoken()
	{
		$accesstoken = \dash\header::get('accesstoken');

		$accesstoken = \dash\validate::md5($accesstoken);

		if(!$accesstoken)
		{
			return false;
		}

		\dash\app\apilog::static_var('apikey', $accesstoken);

		$get =
		[
			'status'  => 'enable',
			'user_id' => [" IS ", " NOT NULL "],
			'type'    => 'member',
			'auth'    => $accesstoken,
			'limit'   => 1,
		];

		$get = \dash\db\user_auth::get($get);

		if(!isset($get['id']) || !isset($get['datecreated']) || !isset($get['user_id']))
		{
			self::stop(401, T_("Invalid accesstoken"));
		}

		\dash\user::init($get['user_id'], 'api_core');

		if(!\dash\user::id())
		{
			return false;
		}

		return true;
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