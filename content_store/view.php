<?php
namespace content_store;


class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);
		\dash\data::include_css(false);


		$myStore = \lib\app\store\mystore::list();
		\dash\data::listStore($myStore);
	}
}
?>
