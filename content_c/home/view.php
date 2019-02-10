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

		self::storeList();

		$where_i_am = \lib\app\store::where_i_am();
		\dash\data::listStore($where_i_am);
	}


	public static function storeList()
	{

		// get list of store of this user
		// cache this number for 1 min
		$list_store = \dash\session::get('user_master_dashboard_'. \dash\user::id(), 'jibres_store');
		if(!$list_store)
		{
			// cache all data for 1 min in this page
			$cache_time = 60;
			$list_store = \lib\app\store::list(null, ['pagenation' => false, 'creator' => \dash\user::id()]);
			\dash\session::set('user_master_dashboard_'. \dash\user::id(), $list_store, 'jibres_store', $cache_time);
		}

		if(is_array($list_store))
		{
			\dash\data::storeCreatorId(array_column($list_store, 'id'));
		}

		\dash\data::stores($list_store);
		\dash\data::storesCount(count($list_store));
	}
}
?>
