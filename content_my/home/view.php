<?php
namespace content_my\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Jibres my'));
		\dash\data::page_desc(T_('Sell and Enjoy'));

		if(!\dash\detect\device::detectPWA())
		{
			// \dash\redirect::to(\dash\url::kingdom(). '/store');
		}
		\dash\data::include_adminPanel(true);
	}
}
?>