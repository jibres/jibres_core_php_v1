<?php
namespace content_a\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Dashboard of :store", ['store' => \dash\face::site()]));

		\dash\face::desc(T_('Glance at your store summary and compare some important data together and enjoy Jibres!'). ' '. T_('Have a good day;)'));

		\dash\data::dashboardData(\lib\app\admin_dashboard\get::get());

		\dash\face::specialTitle(true);
		// back
		\dash\data::back_text(T_('Control Center'));
		\dash\data::back_link(\dash\url::sitelang(). '/my');
	}
}
?>
