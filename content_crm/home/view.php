<?php
namespace content_crm\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_('CRM'));
		\dash\face::desc(T_("Customer relationship management is the process of managing interactions with existing as well as past and potential customers."));

		// fill dashboard data
		\dash\data::dashboardDetail(\dash\app\user\dashboard::detail());

		if(\dash\engine\store::inStore())
		{
			// back
			\dash\data::back_text(T_('Dashboard'));
			\dash\data::back_link(\dash\url::kingdom(). '/a');

		}
		else
		{
						// back
			\dash\data::back_text(T_('Dashboard'));
			\dash\data::back_link(\dash\url::kingdom(). '/love');
		}
	}
}
?>