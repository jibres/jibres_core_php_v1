<?php
namespace content_crm\notification\send;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Send notification"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Notification'));


	}
}
?>
