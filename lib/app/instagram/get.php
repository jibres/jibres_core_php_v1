<?php
namespace lib\app\instagram;

class get
{
	public static function access_token()
	{
		$load = \lib\db\setting\get::by_cat_key('instagram', 'access_token');
		if(isset($load['value']))
		{
			return $load['value'];
		}

		return null;
	}

	public static function user_id()
	{
		$load = \lib\db\setting\get::by_cat_key('instagram', 'user_id');
		if(isset($load['value']))
		{
			return $load['value'];
		}

		return null;
	}


	public static function get_my_posts()
	{
		$access_token = self::access_token();

		$user_id      = self::user_id();

		$access_token = 'IGQVJWVUg5dzdkS1NWSDZApTkFPalpGVmlBejgxWjlpRFhyZAEtMSm1TVGZAZARnRacHBaVjBlUXg1NU50UWFpQmJ6NUlpT1RRYnNDdzN4TTBLN2ZAsd3VvZADFCM2JuYXFVaDI4Q1lxQnZAENVZA2Q21LZAGI5RVVuLWk1Q2JGeUxV';
		$user_id      = '17841401959306742';

		if(!$access_token || !$user_id)
		{
			return [];
		}

		$media_list = \lib\api\instagram\api::getUserMedia($access_token, $user_id);

		if(isset($media_list['data']))
		{
			return $media_list['data'];
		}

		return [];
	}



	/**
	 * Call jibres api to get login url
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function login_url($_business_id)
	{

		$token = $_business_id;
		$token .= '-';
		$token .= microtime();
		$token .= '!_JIBRES_IG_!';
		$token .= rand();
		$token .= '-';
		$token .= rand();
		$token = md5($token);

		$insert =
		[
			'store_id'     => $_business_id,
			'app_id'       => null,
			'token'        => $token,
			'pwd'          => \dash\url::pwd(),

			'access_token' => null,
			'user_id'      => null,
			'request_type' => 'login',
			'username'     => null,
			'status'       => 'enable',
			'send'         => null,
			'receive'      => null,
			'meta'         => null,
			'datecreated'  => date("Y-m-d H:i:s"),
			'expiredate'   => null,
			'datemodified' => null,
		];

		$id = \lib\db\instagram\insert::new_record($insert);

		if(!$id)
		{
			\dash\notif::error(T_("Can not add data"));
			return false;
		}

		$instagram_login_url = \lib\api\instagram\api::getLoginUrl($token);


		return $instagram_login_url;
	}
}
?>