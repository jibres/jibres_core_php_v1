<?php
namespace content_my\wallet;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Electronic Wallet'));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());
	}
}
?>