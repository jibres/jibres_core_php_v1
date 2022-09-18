<?php
namespace content_r10;


class tools
{

	public static $r10 = [];
	private static $lock_on_store = [];


	/**
	 * this function route as first of every request on api
	 */
	public static function master_check()
	{
		\dash\temp::set('isApi', true);

		if(\dash\url::store())
		{
			self::stop(404, T_("Can not set store in url"));
			return false;
		}

		// check jibres module
		if(\dash\url::module() === 'jibres')
		{
			self::check_jibres_api_token();
			return false;

		}

		self::check_accesstoken();

		if(\dash\url::module() === 'domain')
		{
			self::check_appkey();
			self::appkey_required();
			self::accesstoken_required();
		}
	}


	/**
	 * Load jibres token api key from header and check is valid
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	private static function check_jibres_api_token()
	{
		$Authorization = \dash\header::get('HTTP_AUTHORIZATION');

		if(!is_string($Authorization))
		{
			self::stop(400, T_("Authorization is not string!"));
			return false;
		}

		if(!$Authorization)
		{
			self::stop(400, T_("Authorization not set"));
			return false;
		}

		if(mb_strlen($Authorization) > 100)
		{
			self::stop(400, T_("Authorization is too long!"));
			return false;
		}


		$my_Authorization = \dash\setting\whisper::say('jibres_api', 'token');

		if(\dash\utility::hasher($my_Authorization, $Authorization))
		{
			// ok
		}
		else
		{
			self::stop(403, T_("Invalid Authorization"));
			return false;
		}


		// check business
		$business = \dash\header::get('HTTP_X_BUSISNESS');


		if(!$business)
		{
			self::stop(400, T_("Business code is required"));
			return false;
		}

		$business_id = \dash\store_coding::decode($business);

		if(!$business_id)
		{
			self::stop(400, T_("Invalid business id"));
			return false;
		}


		$load_store = \lib\app\store\get::by_id($business_id);
		if(!$load_store)
		{
			self::stop(403, T_("Store not found"));
			return false;
		}

		self::$lock_on_store = $load_store;


		if(in_array(\dash\url::child(), ['ip', 'sms', 'multiplenotif', 'telegram']))
		{
			// needless to check user login
			return true;
		}


		// check user login
		$jibres_user_code = \dash\header::get('HTTP_X_JUSER');
		$business_user    = \dash\header::get('HTTP_X_BUSER');

		$loginIsRequired = true;
		if(in_array(\dash\url::child(), ['plan', 'sms_charge']))
		{
			$loginIsRequired = false;
		}


		// check jibres user code
		if(!$jibres_user_code)
		{
			if($loginIsRequired)
			{
				self::stop(400, T_("Jibres user code required"));
				return false;
			}
			else
			{
				return true;
			}
		}

		if(!\dash\validate::code($jibres_user_code, false))
		{
			if($loginIsRequired)
			{
				self::stop(400, T_("Invalid jibres user code"));
				return false;
			}
			else
			{
				return true;
			}
		}

		$jibres_user = \dash\coding::decode($jibres_user_code);

		if(!\dash\validate::id($jibres_user))
		{
			if($loginIsRequired)
			{
				self::stop(400, T_("Invalid jibres user id"));
				return false;
			}
			else
			{
				return true;
			}
		}

		\dash\user::init($jibres_user, 'api_core');

		if(!\dash\user::id())
		{
			if($loginIsRequired)
			{
				self::stop(403, T_("User not found"));
				return false;
			}
			else
			{
				return true;
			}

		}


	}


	public static function get_current_business_id()
	{
		if(isset(self::$lock_on_store['id']))
		{
			return self::$lock_on_store['id'];
		}

		return null;
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

		$appkey = \dash\validate::md5($appkey, true, ['field_title' => 'appkey']);

		if(!$appkey)
		{
			return false;
		}

		\dash\app\apilog::static_var('appkey', $appkey);

		if(!trim($appkey))
		{
			self::stop(400, T_("Appkey not set"));
		}

		$appkey_is_ok = \dash\app\user_auth::check_appkey($appkey);

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

		$accesstoken = \dash\validate::md5($accesstoken, true, ['field_title' => 'accesstoken']);

		if(!$accesstoken)
		{
			return false;
		}

		\dash\app\apilog::static_var('apikey', $accesstoken);

		$get =
			[
				'status' => 'enable',
				'type'   => 'member',
				'auth'   => $accesstoken,
				'limit'  => 1,
			];

		$get = \dash\db\user_auth::get($get);

		if(!isset($get['id']) || !isset($get['datecreated']) || !isset($get['user_id']) || !a($get, 'user_id'))
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

		if(in_array(intval($_code), [400, 401, 403, 404, 429, 405, 415]) && \dash\engine\process::status())
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