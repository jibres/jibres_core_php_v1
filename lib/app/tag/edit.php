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


	public static function set_sort_property($_group_sort, $_key_sort, $_id)
	{
		if(!\dash\permission::check('manageProductTag'))
		{
			return false;
		}

		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		if(!is_array($_group_sort))
		{
			\dash\notif::error(T_("Invalid sort item detail"));
			return false;
		}

		if(!is_array($_key_sort))
		{
			\dash\notif::error(T_("Invalid sort item detail"));
			return false;
		}

		if(count($_group_sort) !== count($_key_sort))
		{
			\dash\notif::error(T_("Count of group and key is not matched!"));
			return false;
		}

		$group_sort = array_values($_group_sort);
		$key_sort   = array_values($_key_sort);

		$get_category = \lib\db\productcategory\get::one($_id);
		if(!$get_category)
		{
			\dash\notif::error(T_("Tag not founded"));
			return false;
		}

		$new_property = [];
		foreach ($group_sort as $key => $value)
		{
			$new_property[] =
			[
				'group' => $value,
				'key' => a($key_sort, $key),
			];
		}

		$update = [];
		$update['properties'] = json_encode($new_property, JSON_UNESCAPED_UNICODE);

		\lib\db\productcategory\update::record($update, $_id);

		\dash\notif::ok(T_("Saved"));

		return true;
	}


	public static function edit_group($_new_group, $_old_group, $_id)
	{
		if(!\dash\permission::check('manageProductTag'))
		{
			return false;
		}

		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$new_group = \dash\validate::string_50($_new_group);
		$old_group = \dash\validate::string_50($_old_group);

		if(!isset($new_group) || !isset($old_group))
		{
			\dash\notif::error(T_("Please enter the group name"));
			return false;
		}

		$get_category = \lib\db\productcategory\get::one($_id);
		if(!$get_category)
		{
			\dash\notif::error(T_("Tag not founded"));
			return false;
		}

		$old_property = [];

		if(isset($get_category['properties']) && is_array($get_category['properties']))
		{
			$old_property = $get_category['properties'];
		}
		elseif(isset($get_category['properties']) && is_string($get_category['properties']))
		{
			$old_property = json_decode($get_category['properties'], true);
			if(!is_array($old_property))
			{
				$old_property = [];
			}
		}


		$new_property = [];
		foreach ($old_property as $key => $value)
		{
			if(isset($value['group']) && $value['group'] === $old_group)
			{
				$new_property[] =
				[
					'group' => $new_group,
					'key'   => $value['key'],
				];
			}
			else
			{
				$new_property[] = $value;
			}
		}

		$update = [];
		$update['properties'] = json_encode($new_property, JSON_UNESCAPED_UNICODE);

		\lib\db\productcategory\update::record($update, $_id);

		\dash\notif::ok(T_("Saved"));

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
					// create sitemap
					\dash\utility\sitemap::tags($_id);

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