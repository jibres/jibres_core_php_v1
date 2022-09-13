<?php
namespace content_love\plan\home;


class view
{

	public static function config()
	{
		\dash\face::title(T_("Business plans"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		$dashboardDetail = \lib\app\plan\dashboard::detail();
		\dash\data::dashboardDetail($dashboardDetail);

	}

}
