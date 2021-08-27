<?php
namespace content_sudo\curl;


class controller
{
	public static function routing()
	{
		$url = \dash\url::child();

		if($url)
		{
			$url = 'https://'. $url;
		}
		else
		{
			$url = 'https://jibres.ir/ip/me';
		}

		$result = \dash\curl::go($url, null, null, null, true);
		var_dump($result);exit;


	}
}
?>