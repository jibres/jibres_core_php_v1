<?php
namespace content_crm\ip\home;

class view
{
	public static function config()
	{
		\dash\permission::access('crmIP');

		\dash\face::title(T_("IP Detail"));

		\dash\data::action_link(\dash\url::here());
		\dash\data::action_text(T_('Dashboard'));

		$myIp = '8.8.8.8';
		\dash\data::ip(\dash\utility\ipLocation::get($myIp));

		var_dump(\dash\data::ip());exit();
	}
}
?>