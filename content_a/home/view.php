<?php
namespace content_a\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Dashboard of :store", ['store' => \dash\face::site()]));

		\dash\face::desc(T_('Glance at your store summary and compare some important data together and enjoy Jibres!'). ' '. T_('Have a good day;)'));

		\dash\data::dashboardData(\lib\app\cache\get::admin_dashboard());

		// back
		\dash\data::back_text(T_('Control Center'));
		\dash\data::back_link(\dash\url::sitelang(). '/my');
	}
}
?>
