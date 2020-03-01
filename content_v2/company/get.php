<?php
namespace content_v2\company;


class get
{
	public static function route($_company_id)
	{
		if(\dash\request::is('get'))
		{
			$result = self::get_one($_company_id);
			\content_v2\tools::say($result);
		}
		else
		{
			\content_v2\tools::invalid_method();
		}
	}


	private static function get_one($_company_id)
	{
		$detail = \lib\app\company\load::one($_company_id);
		return $detail;
	}
}
?>