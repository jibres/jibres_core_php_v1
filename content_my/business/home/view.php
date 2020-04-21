<?php
namespace content_my\business\home;


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

		// \dash\face::help(\dash\url::support().'/store');

		$myStore = \dash\data::listStore();

		// if store is not exist
		if(isset($myStore['owner']) && $myStore['owner'])
		{
			\dash\face::title(T_("Store Lists"));

			// btn to add new store
			\dash\data::action_text(T_('Add new store'));
			\dash\data::action_link(\dash\url::this(). '/start');
		}
		else
		{
			\dash\face::title(T_("Welcome to Jibres world"));

		}
	}
}
?>