<?php
namespace content_a\customer\export;


class view
{
	public static function config()
	{
		// set usable variable
		$moduleType = \dash\request::get('type');

		// set default title
		$myTitle = T_('Export third party');
		$myDesc  = T_('You can export third party list.');
		// set badge

		$myBadgeLink = \dash\url::this();
		$myBadgeText = T_('Back to third parties list');


		\dash\data::page_title($myTitle);
		\dash\data::page_desc($myDesc);

		\dash\data::badge_text($myBadgeText);
		\dash\data::badge_link($myBadgeLink);

		$dashboard_data = \lib\app\store::dashboard_detail_customer();
		\dash\data::dashboardDetail($dashboard_data);

	}
}
?>
