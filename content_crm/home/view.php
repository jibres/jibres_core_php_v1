<?php
namespace content_crm\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_('CRM'));

		\dash\data::dashboardDetail(\dash\app\user\dashboard::detail());
	}
}
?>