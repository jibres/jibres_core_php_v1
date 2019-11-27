<?php
namespace content_api\v1\user;


class datalist
{
	public static function route()
	{
		if(\dash\request::is('get'))
		{
			$result = self::list();
			\content_api\v1::say($result);
		}
		else
		{
			\content_api\v1::invalid_method();
		}
	}


	private static function list()
	{
		j($_SESSION);
		$detail = \lib\app\user\load::one($_user_id);
		return $detail;
	}
}
?>