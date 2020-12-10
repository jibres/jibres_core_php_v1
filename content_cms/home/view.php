<?php
namespace content_cms\home;

class view
{

	public static function config()
	{
		\dash\data::dash_version(\dash\engine\version::get());
		\dash\data::dash_lastUpdate(\dash\utility\git::getLastUpdate());

		\dash\face::title(T_('CMS'));

		\dash\data::back_text(T_("Dashboard"));
		\dash\data::back_link(\dash\url::kingdom(). '/a');

		\dash\data::dashboardDetail(\dash\app\posts\dashboard::detail());
	}
}
?>