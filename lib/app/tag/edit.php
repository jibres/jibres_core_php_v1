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


	public static function clone($_clone, $_id)
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

		if(!$_clone || !is_numeric($_clone))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$get_category = \lib\db\productcategory\get::one($_id);
		if(!$get_category)
		{
			\dash\notif::error(T_("Tag not founded"));
			return false;
		}

		$get_clone = \lib\db\productcategory\get::one($_clone);
		if(!$get_clone)
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


		$clone_property = [];

		if(isset($get_clone['properties']) && is_array($get_clone['properties']))
		{
			$clone_property = $get_clone['properties'];
		}
		elseif(isset($get_clone['properties']) && is_string($get_clone['properties']))
		{
			$clone_property = json_decode($get_clone['properties'], true);
			if(!is_array($clone_property))
			{
				$clone_property = [];
			}
		}

		$check_duplicate = [];
		foreach ($old_property as $key => $value)
		{
			$check_duplicate[] = a($value, 'group'). a($value, 'key');
		}


		$new_property = $old_property;

		$count = 0;

		foreach ($clone_property as $key => $value)
		{
			if(!in_array(a($value, 'group'). a($value, 'key'), $check_duplicate))
			{
				$new_property[] = $value;
				$count++;
			}
		}

		if(!$count)
		{
			\dash\notif::info(T_("No property found to add to list"));
			return true;
		}
		else
		{
			\dash\notif::ok(T_(":val property added", ['val' => \dash\fit::number($count)]));
		}

		$update = [];
		$update['properties'] = json_encode($new_property, JSON_UNESCAPED_UNICODE);

		\lib\db\productcategory\update::record($update, $_id);


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
					if(isset($args['slug']))
					{
						\lib\app\menu\update::tag($_id, true);
					}
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




	private static $sort_level = [];

	public static function sort($_args)
	{
		if(!is_array($_args))
		{
			\dash\notif::error(T_("Sort arguments must be array"));
			return false;
		}

		$args = array_values($_args);

		$update = [];

		foreach ($args as $sort_number => $string)
		{
			$split  = explode('-', $string);

			$my_sort = $sort_number + 1;

			if(count($split) === 0)
			{
				return false;
			}
			elseif(count($split) === 1)
			{
				$level1 = self::get_level_id($split[0]);
				if(!$level1)
				{
					return false;
				}

				$update[$level1['id']] = ['parent1' => null, 'parent2' => null, 'parent3' => null, 'parent4' => null,  'sort' => $my_sort,];
			}
			elseif(count($split) === 2)
			{
				$level1 = self::get_level_id($split[0]);
				if(!$level1)
				{
					return false;
				}

				$level2 = self::get_level_id($split[1]);
				if(!$level2)
				{
					return false;
				}

				$update[$level2['id']] = ['parent1' => $level1['id'], 'parent2' => null, 'parent3' => null, 'parent4' => null, 'sort' => $my_sort];
			}
			elseif(count($split) === 3)
			{
				$level1 = self::get_level_id($split[0]);
				if(!$level1)
				{
					return false;
				}

				$level2 = self::get_level_id($split[1]);
				if(!$level2)
				{
					return false;
				}

				$level3 = self::get_level_id($split[2]);
				if(!$level3)
				{
					return false;
				}

				$update[$level3['id']] = ['parent1' => $level1['id'], 'parent2' => $level2['id'], 'parent3' => null, 'parent4' => null, 'sort' => $my_sort];

			}
			elseif(count($split) === 4)
			{
				$level1 = self::get_level_id($split[0]);
				if(!$level1)
				{
					return false;
				}

				$level2 = self::get_level_id($split[1]);
				if(!$level2)
				{
					return false;
				}

				$level3 = self::get_level_id($split[2]);
				if(!$level3)
				{
					return false;
				}

				$level4 = self::get_level_id($split[3]);
				if(!$level4)
				{
					return false;
				}

				$update[$level4['id']] = ['parent1' => $level1['id'], 'parent2' => $level2['id'], 'parent3' => $level3['id'], 'parent4' => null, 'sort' => $my_sort];

			}
			elseif(count($split) === 5)
			{
				$level1 = self::get_level_id($split[0]);
				if(!$level1)
				{
					return false;
				}

				$level2 = self::get_level_id($split[1]);
				if(!$level2)
				{
					return false;
				}

				$level3 = self::get_level_id($split[2]);
				if(!$level3)
				{
					return false;
				}

				$level4 = self::get_level_id($split[3]);
				if(!$level4)
				{
					return false;
				}

				$level5 = self::get_level_id($split[4]);
				if(!$level5)
				{
					return false;
				}

				$update[$level5['id']] = ['parent1' => $level1['id'], 'parent2' => $level2['id'], 'parent3' => $level3['id'], 'parent4' => $level4['id'], 'sort' => $my_sort];
			}
		}

		if(!empty($update))
		{
			$error = false;
			foreach ($update as $id => $detail)
			{
				$parent1 = $detail['parent1'];
				$parent2 = $detail['parent2'];
				$parent3 = $detail['parent3'];
				$parent4 = $detail['parent4'];

				if($parent1 && !$parent2 && !$parent3 && !$parent4)
				{
					// ok
				}
				elseif($parent1 && $parent2 && !$parent3 && !$parent4)
				{
					if(isset($update[$parent2]['parent2']) && $update[$parent2]['parent2'])
					{
						$error = true;
					}
				}
				elseif($parent1 && $parent2 && $parent3 && !$parent4)
				{
					if(isset($update[$parent3]['parent3']) && $update[$parent3]['parent3'])
					{
						$error = true;
					}
				}
				elseif($parent1 && $parent2 && $parent3 && $parent4)
				{
					if(isset($update[$parent4]['parent4']) && $update[$parent4]['parent4'])
					{
						$error = true;
					}
				}

			}

			if($error)
			{
				\dash\notif::error(T_("Can not save this tag level!"));
				return false;
			}

			\lib\db\productcategory\update::sort_level($update);
		}

	}


	private static function get_level_id($_string)
	{
		$split_level = explode('_', $_string);

		$level       = null;
		$id          = null;

		if(isset($split_level[0]))
		{
			$level = \dash\validate::tinyint($split_level[0]);

			if(!isset($level))
			{
				return false;
			}

			$level = intval($level) + 1;

			if(!in_array($level, [1,2,3,4,5]))
			{
				$level = null;
			}
		}

		if(isset($split_level[1]))
		{
			$id = \dash\validate::id($split_level[1]);
			if(!$id)
			{
				return false;
			}
		}

		$result          = [];
		$result['id']    = $id;
		$result['level'] = $level;

		return $result;
	}


}
?>