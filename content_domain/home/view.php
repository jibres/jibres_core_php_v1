<?php
namespace content_domain\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Jibres Domans"));

		\dash\data::page_special(true);
	}
}
?>