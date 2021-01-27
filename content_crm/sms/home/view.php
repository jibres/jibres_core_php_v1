<?php
namespace content_crm\sms\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("SMS"));

		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('CRM'));



	}
}
?>
