<?php
namespace content_c\home;


class view extends \content_c\main\view
{
	public function config()
	{
		$this->data->page['title']   = T_("Jibres Dashboard");
		$this->data->page['desc']    = T_("Glance at your stores and quickly navigate to stores.");
		$this->data->page['special'] = true;

		$this->data->dateDetail      = \dash\date::month_precent();

		// cache all data for 1 min in this page
		$cache_time = 60;

		// get list of store of this user
		// cache this number for 1 min
		$list_store = \dash\session::get('get_list_store_dashboard_'. \dash\user::id());
		if(!$list_store)
		{
			$list_store = \lib\app\store::list(['pagenation' => false]);
			\dash\session::set('get_list_store_dashboard_'. \dash\user::id(), $list_store, null, $cache_time);
		}
		$this->data->list_store = $list_store;
		$this->data->count_store_by_creator = count($list_store);

	}
}
?>
