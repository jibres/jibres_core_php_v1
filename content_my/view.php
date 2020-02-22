<?php
namespace content_my;


class view
{
	public static function config()
	{
		\dash\data::include_adminPanel(true);
		\dash\data::page_titleBox(true);


		$myStore = \lib\app\store\mystore::list();
		\dash\data::listStore($myStore);
	}
}
?>
