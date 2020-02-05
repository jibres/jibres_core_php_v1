<?php
namespace content\whois;


class model
{
	public static function post()
	{
		$domain = \dash\request::post('domain');
		if(!$domain)
		{
			\dash\notif::error(T_("Please fill domain"), 'domain');
			return false;
		}

		if(!\lib\nic\app\domain\check::syntax($domain))
		{
			\dash\notif::error(T_("Please enter a valid domain"), 'domain');
			return false;
		}

		$url = \dash\url::this(). '/'. $domain;

		\dash\redirect::to($url);


	}
}
?>