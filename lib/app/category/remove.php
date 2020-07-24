<?php
namespace lib\app\category;


class remove
{

	public static function remove_file($_id)
	{
		$load = \lib\app\category\get::inline_get($_id);
		if($load)
		{
			\dash\upload\category::remove($_id);
			\lib\db\productcategory\update::unset_file($_id);
		}
	}


	public static function remove($_id)
	{
		if(!\dash\permission::check('productCategoryDelete'))
		{
			return false;
		}

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		$load = \lib\app\category\get::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		if(isset($load['count']) && $load['count'])
		{
			\dash\notif::error(T_("Some product save by this category and you can not remove it"));
			return false;
		}


		\lib\db\productcategory\delete::record($_id);

		\dash\notif::ok(T_("Category successfully removed"));

		return true;
	}


}
?>