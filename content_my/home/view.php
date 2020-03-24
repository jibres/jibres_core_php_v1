<?php
namespace content_my\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Jibres my'));
		\dash\data::page_titleBox(false);

		if(!\dash\detect\device::detectPWA())
		{
			\dash\data::page_title(' ');

			\dash\data::page_titleBox(true);
			\dash\data::action_text(T_('Stores'));
			\dash\data::action_link(\dash\url::here() . '/store');

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