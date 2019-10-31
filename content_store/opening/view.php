<?php
namespace content_store\opening;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Big Opening"));

		\dash\data::userToggleSidebar(false);
	}
}
?>