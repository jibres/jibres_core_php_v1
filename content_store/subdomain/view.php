<?php
namespace content_store\subdomain;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Store online address"));

		\dash\data::userToggleSidebar(false);
	}
}
?>
