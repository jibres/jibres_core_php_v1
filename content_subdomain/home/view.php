<?php
namespace content_subdomain\home;


class view
{
	public static function config()
	{
		\dash\data::store(\lib\store::detail());

		\dash\data::site_title(\dash\data::store_name(). ' | '. \dash\data::site_title());
		\dash\data::site_desc(\dash\data::store_desc());
	}
}
?>