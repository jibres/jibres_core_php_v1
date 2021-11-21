<?php
namespace lib\app\instagram;

class get
{

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