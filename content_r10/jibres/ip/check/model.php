<?php
namespace content_r10\jibres\ip\check;


class model
{
	public static function post()
	{
		$ip = \dash\request::input_body('ip');

		$result = [];

		if($ip)
		{
			$result = \dash\utility\ip::fetch($ip);
		}

		\content_r10\tools::say($result);

	}
}
?>