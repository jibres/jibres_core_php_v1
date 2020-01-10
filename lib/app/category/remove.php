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


	public static function remove($_args, $_id)
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

		\dash\app::variable($_args);

		$load = \lib\app\category\get::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$id = \dash\coding::decode($_id);

		$count_product = \lib\db\productcategory\get::get_count_product($id);
		$count_product = intval($count_product);

		if($count_product > 0)
		{
			$whattodo = \dash\app::request('whattodo');
			if(!in_array($whattodo, ['non-category','new-category']))
			{
				\dash\notif::error(T_("What to do for old category?"));
				return false;
			}

			$check = null;

			$category = \dash\app::request('category');
			if($category)
			{
				$check = \lib\app\category\get::inline_get($category);
				if(!$check)
				{
					\dash\notif::error(T_("Invalid new category id!"));
					return false;
				}
			}

			if($whattodo === 'new-category' && !isset($check['id']))
			{
				\dash\notif::error(T_("Please select one category"), 'category');
				return false;
			}

			$old_category_id    = \dash\coding::decode($_id);

			if($whattodo === 'new-category')
			{
				$new_category_id    = $check['id'];
				$new_category_title = $check['title'];

				\lib\db\products\category::update_all_product_by_category($new_category_id, $new_category_title, $old_category_id);
			}
			else
			{
				\lib\db\products\category::update_all_product_by_category(null, null, $old_category_id);
			}
		}

		\dash\log::set('productCategoryDeleted', ['old' => $load]);

		\lib\db\productcategory\delete::delete($id);

		\dash\notif::ok(T_("Category successfully removed"));

		return true;
	}


}
?>