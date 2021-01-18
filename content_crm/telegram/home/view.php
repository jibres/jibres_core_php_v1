<?php
namespace content_crm\telegram\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Telegram"));

		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('CRM'));

	}
}
?>
