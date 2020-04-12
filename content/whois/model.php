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

		$domain = \dash\validate::domain($domain, false);

		if(!$domain)
		{
			\dash\notif::error(T_("Please enter a valid domain"), 'domain');
			return false;
		}

		$url = \dash\url::kingdom(). '/whois/'. $domain;

		\dash\redirect::to($url);


	}
}
?>