<?php
namespace content_crm\sms\send;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Send sms"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('SMS'));


	}
}
?>
