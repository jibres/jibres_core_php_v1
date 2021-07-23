<?php
namespace content_a\accounting\home;


class view
{
	public static function config()
	{
		$dashboardDetail = \lib\app\tax\doc\dashboard::detail();

		\dash\data::dashboardDetail($dashboardDetail);

		$title = T_('Cloud Accounting');

		if(a($dashboardDetail, 'year_title'))
		{
			$title .= ' - '. a($dashboardDetail, 'year_title');
		}
		\dash\face::title($title);

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\face::btnSetting(\dash\url::this().'/config');


	}
}
?>