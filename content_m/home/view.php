<?php
namespace content_m\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Jibres Management"));

		\dash\data::page_special(true);
	}
}
?>