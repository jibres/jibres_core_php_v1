<?php
namespace content_b1;


class tools
{
	public static $b1             = [];


	/**
	 * this function route as first of every request on api
	 */
	public static function master_check()
	{
		// set is api variable to check somewhere
		\dash\temp::set('isApi', true);
		$check_permission = true;

		if(\dash\url::module() === 'business')
		{
			self::check_bpi_token();

			$check_permission = false;

		}
		else
		{

			self::check_apikey();

			self::apikey_required();

		}

		if(!\dash\url::store())
		{
			self::stop(404, T_("Please set store code in url"));
			return false;
		}

		if(!\lib\store::id())
		{
			self::stop(404, T_("Store not found"));
		}

		if($check_permission)
		{
			// maybe some where have erro. but need fix other palce.
			// this content need have any permission
			if(!\dash\permission::has_permission())
			{
				\dash\permission::deny();
			}
		}

	}



	private static function apikey_required()
	{

		// some directory needless to check api key
		$public_directory =
		[
			'posts/latest',
			'comments/add',
		];

		if(in_array(\dash\url::directory(), $public_directory))
		{
			// needless to require apikey
		}
		else
		{
			if(!\dash\user::id())
			{
				self::stop(403, T_("Apikey not set"));
			}
		}
	}



	/**
	 * Load jibres token api key from header and check is valid
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function check_bpi_token()
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


		$my_Authorization = \dash\setting\whisper::say('jibres_api', 'bpi_token');

		if(\dash\utility::hasher($my_Authorization, $Authorization))
		{
			// ok
		}
		else
		{
			self::stop(403, T_("Invalid Authorization"));
			return false;
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

		$user_id = $get['user_id'];

		\dash\user::init($user_id, 'api_business');

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