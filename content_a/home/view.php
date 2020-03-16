<?php
namespace content_a\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Dashboard of your store"));
		\dash\data::page_desc(T_('Glance at your store summary and compare some important data together and enjoy Jibres!'). ' '. T_('Have a good day;)'));

		\dash\data::dashboardData(\lib\app\cache\get::admin_dashboard());

		\dash\data::loadScript(true);
	}
}
?>
