<?php
namespace content_sudo\curl;


class controller
{
	public static function routing()
	{
		$url = \dash\request::get('url');

		if($url)
		{
			if(substr($url, 0, 5) === 'https')
			{
				$url = 'https://'. substr($url, 5);

			}
			else
			{
				$url = 'http://'. $url;
			}
		}
		else
		{
			$url = 'https://jibres.ir/ip/me';
		}

		$result = \dash\curl::go($url, null, null, null, true);

		\dash\code::jsonBoom($result, 'text');


	}
}
?>