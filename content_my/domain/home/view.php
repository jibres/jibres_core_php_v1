<?php
namespace content_my\domain\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Jibres Domain Center"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::action_text(T_('Buy your dream domain'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::this(). '/buy');

		\dash\face::btnImport(\dash\url::this().'/import');
		// \dash\face::btnExport(\dash\url::this().'/export');
		\dash\face::help(\dash\url::support().'/domain');

		$dashboard_detail = \lib\app\nic_domain\dashboard::user();
		\dash\data::dashboardDetail($dashboard_detail);
	}
}
?>
