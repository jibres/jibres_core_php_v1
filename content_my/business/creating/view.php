<?php
namespace content_my\business\creating;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Creating your business"));
		\lib\app\store\timeline::set('creating');

		\dash\data::userToggleSidebar(false);

		\dash\data::global_scriptPage('store_creating.js');
	}
}
?>