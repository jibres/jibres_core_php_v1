<?php
namespace content_c\store;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Stores"));
		\dash\data::page_desc(T_("View list of stores and add new one easily just in seconds."));

		\dash\data::stores(\lib\app\store::list());
	}
}
?>
