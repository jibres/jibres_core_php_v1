<?php
namespace content_my\domain\search;


class model
{
	public static function post()
	{
		$domain = \dash\request::post('domain');
		if(!$domain)
		{
			\dash\redirect::to(\dash\url::this());
		}

		if(!\dash\validate::domain($domain))
		{
			\dash\notif::error(T_("Please enter a valid domain"), 'domain');
			return false;
		}

		$url = \dash\url::this(). '/'. $domain;

		\dash\redirect::to($url);


	}
}
?>