<?php
namespace content_my\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Jibres my'));
		\dash\data::page_desc(T_('Sell and Enjoy'));

		\dash\data::page_titleBox(false);

		if(!\dash\detect\device::detectPWA())
		{
			self::site_detail();
		}
	}


	private static function site_detail()
	{
		$myStore = \lib\app\store\mystore::list();
		\dash\data::listStore($myStore);
	}
}
?>