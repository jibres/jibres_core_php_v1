<?php
namespace content_love\sms\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Sms"));


		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());



	}
}
?>
