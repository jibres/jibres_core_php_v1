<?php
namespace content_crm\telegram\send;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Send Message"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Telegram'));


	}
}
?>
