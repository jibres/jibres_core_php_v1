<?php
namespace content_api\v1\user;


class get
{
	public static function route($_user_id)
	{
		if(\dash\request::is('get'))
		{
			$result = self::get_one($_user_id);
			\content_api\v1::say($result);
		}
		else
		{
			\content_api\v1::invalid_method();
		}
	}


	private static function get_one($_user_id)
	{
		$detail = \lib\app\user\load::one($_user_id);
		return $detail;
	}
}
?>