<?php
namespace content_crm\ticket\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Tickets"));

		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('CRM'));

		\dash\data::action_link(\dash\url::this(). '/add');
		\dash\data::action_text(T_('Add new ticket'));

		$dashboardDetail = \dash\app\ticket\dashboard::detail();
		\dash\data::dashboardDetail($dashboardDetail);

	}
}
?>
