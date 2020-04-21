<?php
namespace content_my\store\creating;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Creating your store"));
		\lib\app\store\timeline::set('creating');

		\dash\data::userToggleSidebar(false);

		\dash\data::loadScript('/js/page/store_creating.js');
	}
}
?>