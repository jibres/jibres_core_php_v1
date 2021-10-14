<?php
namespace content_a\setting\domain\remove;

class controller
{
	public static function routing()
	{
		\dash\permission::access('siteBuilderSetting');

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