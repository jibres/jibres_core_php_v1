<?php
namespace content_my\store\home;


class view
{
	public static function config()
	{
		// btn
		if(!\dash\detect\device::detectPWA())
		{
			\dash\data::back_text(T_('Dashboard'));
			\dash\data::back_link(\dash\url::here());
		}

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