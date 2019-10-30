<?php
namespace content_store\ask;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Add New Store"));

		\dash\data::userToggleSidebar(false);
	}
}
?>
