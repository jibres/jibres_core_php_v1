<?php
namespace content_cms\home;

class view
{

	public static function config()
	{
		\dash\face::title(T_('CMS'));

		\dash\data::back_text(T_("Dashboard"));
		\dash\data::back_link(\dash\url::kingdom(). '/a');

		\dash\data::dashboardDetail(\dash\app\posts\dashboard::detail());

		\dash\face::btnSetting(\dash\url::here(). '/setting');
	}
}
?>