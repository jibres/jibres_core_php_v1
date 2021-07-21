<?php
namespace content_a\accounting\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Cloud Accounting'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\face::btnSetting(\dash\url::this().'/config');

		\dash\data::dashboardDetail(\lib\app\tax\doc\dashboard::detail());

	}
}
?>