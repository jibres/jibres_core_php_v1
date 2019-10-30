<?php
namespace content_store\home;


class view
{
	public static function config()
	{

		\dash\data::page_titleBox(true);
		\dash\data::page_help(\dash\url::support().'/store');

		// btn
		\dash\data::page_btnText(T_('Add new store'));
		\dash\data::page_btnLink(\dash\url::this(). '/start');

		$myStore = \lib\app\store\mystore::list();
		\dash\data::listStore($myStore);

		// if store is not exist
		if(isset($myStore['owner']) && $myStore['owner'])
		{
			\dash\data::page_title(T_("Store Lists"));
		}
		else
		{
			\dash\data::page_title(T_("Welcome to Jibres world"));
			\dash\data::page_special(true);
		}
	}
}
?>