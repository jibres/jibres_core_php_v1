<?php
namespace content_subdomain\home;


class view
{
	public static function config()
	{
		\dash\data::store(\lib\store::detail());


		\dash\face::site(\dash\get::index(\dash\data::store(), 'store_data', 'title'));
		\dash\data::site_desc(\dash\data::store_desc());
	}
}
?>