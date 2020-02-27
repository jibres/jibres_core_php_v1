<?php
namespace content_account\home;

class view
{

	public static function config()
	{
		\dash\data::page_title(T_('Account'));
		\dash\data::page_tbox(false);

		if(\dash\detect\device::detectPWA())
		{
			// back
			\dash\data::back_text(T_('Dashboard'));
			\dash\data::back_link(\dash\url::kingdom(). '/my');
		}

	}
}
?>