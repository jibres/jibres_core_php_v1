<?php
namespace content_my\business\creating;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Creating your business"));

		\dash\data::include_m2('wide');

		\dash\data::global_scriptPage('store_creating.js');
	}
}
?>