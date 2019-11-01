<?php
namespace content_store\creating;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Creating your store"));

		\dash\data::userToggleSidebar(false);
	}
}
?>