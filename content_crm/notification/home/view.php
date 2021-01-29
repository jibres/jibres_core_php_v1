<?php
namespace content_crm\notification\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Notifications"));

		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('CRM'));

	}
}
?>
