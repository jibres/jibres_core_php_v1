<?php
namespace lib\app\category;


class get
{


	public static function inline_get($_id)
	{
		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$load = \lib\db\productcategory\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		return $load;
	}


	public static function get($_id)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\dash\permission::access('productCategoryListView');

		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$load = \lib\db\productcategory\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$load['count'] = \lib\db\productcategory\get::get_count_product($_id);
		$load = \lib\app\category\ready::row($load);
		return $load;
	}


	public static function parent_list($_id = null)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			$_id = null;
		}

		$all_list = \lib\db\productcategory\get::parent_list($_id);
		if(!is_array($all_list))
		{
			$all_list = [];
		}

		$all_list = array_map(['\\lib\\app\\category\\ready', 'row'], $all_list);
		return $all_list;
	}


	public static function parent_property($_id = null)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			$_id = null;
		}

		$parent_property = \lib\db\productcategory\get::parent_property($_id);
		if(!is_array($parent_property))
		{
			$parent_property = [];
		}



		$parent_property = array_map(['\\lib\\app\\category\\ready', 'row_property'], $parent_property);


		return $parent_property;
	}



	public static function by_url($_url)
	{
		$url = \dash\validate::string_400($_url, false);

		if(!$url)
		{
			return false;
		}

		$load = \lib\db\productcategory\get::by_url($url);

		if(!$load)
		{
			return false;
		}

		$load = \lib\app\category\ready::row($load);

		return $load;
	}


}
?>