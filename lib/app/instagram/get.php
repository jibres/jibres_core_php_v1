<?php
namespace lib\app\instagram;

class get
{

	public static function login_url()
	{
		$token = \lib\store::code_raw();
		$token.= '-';
		$token .= md5(microtime(). '!_JIBRES_IG_!'. rand(). '_'. rand());


		var_dump($token);exit;

		$url = \lib\api\instagram\api::getLoginUrl($token);

		return $url;
	}
}
?>