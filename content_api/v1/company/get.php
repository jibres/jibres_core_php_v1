<?php
namespace content_api\v1\company;


class get
{
	public static function route($_company_id)
	{
		if(\dash\request::is('get'))
		{
			$result = self::get_one($_company_id);
			\content_api\v1::say($result);
		}
		else
		{
			\content_api\v1::invalid_method();
		}
	}


	private static function get_one($_company_id)
	{
		$detail = \lib\app\company\load::one($_company_id);
		return $detail;
	}
}
?>