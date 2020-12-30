<?php
namespace content_cms\files\setting;


class view
{
	public static function config()
	{

		\dash\face::title(T_("Files"));

		\dash\data::back_text(T_('Files'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::dashboardDetail(\dash\app\files\get::dashboard_detail());


	}
}
?>