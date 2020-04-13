<?php
namespace content_my\domain\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domains"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::action_text(T_('NIC Notification'));
		\dash\data::action_link(\dash\url::this(). '/poll');

		\dash\face::btnImport(\dash\url::this().'/import');
		// \dash\face::btnExport(\dash\url::this().'/export');
		\dash\face::help(\dash\url::support().'/domain');
	}
}
?>
