<?php
namespace content_domain\home;


class model
{
	public static function post()
	{
		$domain = \dash\request::post('domain');
		if(!$domain)
		{
			\dash\redirect::to(\dash\url::here());
		}

		if(!\lib\app\nic_domain\check::syntax($domain))
		{
			\dash\notif::error(T_("Please enter a valid domain"), 'domain');
			return false;
		}

		$url = \dash\url::here(). '/'. $domain;

		\dash\redirect::to($url);


	}
}
?>