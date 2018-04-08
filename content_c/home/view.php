<?php
namespace content_c\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Jibres Dashboard"));
		\dash\data::page_desc(T_("Glance at your stores and quickly navigate to stores."));
		\dash\data::page_special(true);

		\dash\data::dateDetail(\dash\date::month_precent());


		// get list of store of this user
		// cache this number for 1 min
		$list_store = \dash\session::get('get_list_store_dashboard_'. \dash\user::id());
		if(!$list_store)
		{
			// cache all data for 1 min in this page
			$cache_time = 60;
			$list_store = \lib\app\store::list(['pagenation' => false]);
			\dash\session::set('get_list_store_dashboard_'. \dash\user::id(), $list_store, null, $cache_time);
		}
		\dash\data::stores($list_store);
		\dash\data::storesCount(count($list_store));
	}
}
?>
