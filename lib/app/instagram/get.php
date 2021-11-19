<?php
namespace lib\app\instagram;

class get
{

	public static function login_url()
	{
		$token = \lib\store::code_raw();
		$token.= '-';
		$token .= md5(microtime(). '!_JIBRES_IG_!'. rand(). '_'. rand());


		$insert =
		[
			'token'        => $token,
			'type'         => 'login',
			'username'     => null,
			'code'         => null,
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

		$url = \lib\api\instagram\api::getLoginUrl($token);

		return $url;
	}
}
?>