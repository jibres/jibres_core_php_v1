<?php
namespace content_c\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Jibres Dashboard"));
		\dash\data::page_desc(T_("Glance at your stores and quickly navigate to stores."));
		\dash\data::page_special(true);


		$myStore = \lib\app\store\mystore::list();
		\dash\data::listStore($myStore);
	}
}
?>