<?php
namespace content_my\store\creating;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Creating your store"));
		\lib\app\store\timeline::set('creating');

		\dash\data::userToggleSidebar(false);

		\dash\data::loadScript(true);
	}
}
?>