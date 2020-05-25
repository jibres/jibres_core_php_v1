<?php
namespace content_crm\sms\home;

class view
{
	public static function config()
	{
		\dash\permission::access('crmIP');

		\dash\face::title(T_("IP Detail"));

		\dash\data::action_link(\dash\url::here());
		\dash\data::action_text(T_('Dashboard'));


		\dash\data::ip(123);
	}
}
?>