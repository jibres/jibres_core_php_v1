<?php
namespace lib\app\tag;


class edit
{
	public static function set_sort($_sort)
	{
		$sort = [];

		foreach ($_sort as $key => $value)
		{
			$value = \dash\validate::id($value);
			if(!$value)
			{
				\dash\notif::error(T_("Invalid id"));
				return false;
			}

			$sort[] = $value;
		}

		if(!$sort)
		{
			\dash\notif::info(T_("No data to sort"));
			return;
		}

		\lib\db\productcategory\update::set_sort($sort);

		return true;
	}


	public static function edit($_args, $_id, $_properties = [])
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('manageProductTag'))
		{
			return false;
		}

		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$args = \lib\app\tag\check::variable($_args, $_id, $_properties);

		if(!$args)
		{
			return false;
		}

		$get_category = \lib\db\productcategory\get::one($_id);

		if(isset($get_category['id']) && isset($get_category['title']) && $get_category['title'] == $args['title'])
		{
			if(floatval($get_category['id']) === floatval($_id))
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Duplicate category founded"), 'category');
				return false;
			}
		}



		$args = \dash\cleanse::patch_mode($_args, $args);

		if(isset($args['title']) && array_key_exists('seotitle', $get_category) && !$get_category['seotitle'])
		{
			$args['seotitle'] = \dash\validate::seotitle($args['title'], false);
		}

		if(isset($args['desc']) && array_key_exists('seodesc', $get_category) && !$get_category['seodesc'])
		{
			$args['seodesc'] = \dash\validate::seodesc($args['desc'], false);
		}

		if(!empty($args))
		{
			foreach ($get_category as $field => $value)
			{
				if(array_key_exists($field, $args) && \dash\validate::is_equal($args[$field], $value))
				{
					unset($args[$field]);
				}
			}

			if(empty($args))
			{
				\dash\notif::info(T_("No change in your product category"));
				return null;
			}
			else
			{
				$update = \lib\db\productcategory\update::record($args, $_id);

				if($update)
				{

					\dash\log::set('productCategoryUpdated', ['old' => $get_category, 'change' => $args]);
					\dash\notif::ok(T_("The category successfully updated"));
					return true;
				}
				else
				{
					\dash\log::set('productcategoryDbCannotUpdate');
					\dash\notif::error(T_("Can not update your product category"));
					return false;
				}
			}
		}
		else
		{
			\dash\notif::info(T_("Category saved without chnage"));
			return false;
		}
	}


}
?>