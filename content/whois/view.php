<?php
namespace content\whois;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Whois'));
		\dash\data::page_desc(T_("Check domain"));
	}
}
?>