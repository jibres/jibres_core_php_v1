<?php
namespace content_store\home;


class view
{
	public static function config()
	{

		\dash\data::page_titleBox(true);
		// \dash\data::page_help(\dash\url::support().'/store');

		$myStore = \dash\data::listStore();

		// if store is not exist
		if(isset($myStore['owner']) && $myStore['owner'])
		{
			\dash\data::page_title(T_("Store Lists"));

			// btn to add new store
			\dash\data::action_text(T_('Add new store'));
			\dash\data::action_link(\dash\url::this(). '/start');
			\dash\data::page_btnDirect(true);
		}
		else
		{
			\dash\data::page_title(T_("Welcome to Jibres world"));
			\dash\data::page_special(true);
		}
	}
}
?>