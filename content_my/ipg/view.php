<?php
namespace content_my\ipg;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Internet Payment Gateway'));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());
	}
}
?>