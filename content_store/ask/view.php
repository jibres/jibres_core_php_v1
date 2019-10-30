<?php
namespace content_store\ask;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Help Jibres work better"));

		\dash\data::polls(\lib\polls::all());

		\dash\data::userToggleSidebar(false);
	}
}
?>
