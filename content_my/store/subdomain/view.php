<?php
namespace content_my\store\subdomain;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Store online address"));

		\lib\app\store\timeline::set('subdomain');

		\dash\data::userToggleSidebar(false);
	}
}
?>
