<?php
namespace content_cms\files\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Files"));

		\dash\data::action_text(T_('Upload'));
		\dash\data::action_link(\dash\url::this(). '/add');

		\dash\data::back_text(T_('CMS'));
		\dash\data::back_link(\dash\url::here());

		$dashboard_detail = \dash\app\files\dashboard::detail();
		\dash\data::dashboardDetail($dashboard_detail);

	}
}
?>