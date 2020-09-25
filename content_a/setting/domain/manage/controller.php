<?php
namespace content_a\setting\domain\manage;

class controller
{
	public static function routing()
	{
		$domain = \dash\request::get('domain');
		if(!$domain)
		{
			\dash\header::status(404);
		}

		$load = \lib\app\business_domain\get::my_store_domain($domain);

		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::domainDetail($load);

		\dash\data::domainID($load['id']);
	}
}
?>