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


	public static function remove_action($_id, $_action)
	{
		$load = \lib\app\category\get::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		if(isset($load['count']) && $load['count'])
		{
			// ok
		}
		else
		{
			return self::remove($_id);
		}

		if(isset($_action['type']) && $_action['type'] === 'select_new_category')
		{
			if(isset($_action['new_cat_id']))
			{
				$load_new = \lib\app\category\get::inline_get($_action['new_cat_id']);

				if(!isset($load_new['id']))
				{
					\dash\notif::error(T_("Invalid category id"));
					return false;
				}

				\lib\db\productcategoryusage\update::category_usage_cat_id($load['id'], $load_new['id']);
			}
			else
			{
				\dash\notif::error(T_("Please select one category"));
				return false;
			}
		}
		else
		{
			// remove this category from all product
			\lib\db\productcategoryusage\delete::category_usage_cat_id($load['id']);
		}

		return self::remove($_id);

	}


	public static function remove($_id)
	{
		if(!\dash\permission::check('productCategoryDelete'))
		{
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