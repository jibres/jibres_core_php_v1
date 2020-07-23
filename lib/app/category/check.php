<?php
namespace lib\app\category;


class check
{

	public static function variable($_args, $_id = null, $_properties = [])
	{
		$condition =
		[
			'title'         => 'title',
			'desc'          => 'html',
			'slug'          => 'slug',
			'file'          => 'string',
			'parent'        => 'id',
			'seotitle'      => 'seotitle',
			'seodesc'       => 'seodesc',
			'showonwebsite' => 'bit',

		];

		$require = ['title'];

		$meta =
		[
			'field_title' => ['properties_key' => T_("Property key"), 'properties_group' => T_("Group properties")],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['slug'])
		{
			$data['slug'] = \dash\validate::slug($data['title'], false);
		}

		$parent1 = null;
		$parent2 = null;
		$parent3 = null;

		// if($data['parent'])
		// {

		// 	$load_parent = \lib\app\category\get::inline_get($data['parent']);
		// 	if(!$load_parent)
		// 	{
		// 		\dash\notif::error(T_("Parent not found"), 'parent');
		// 		return false;
		// 	}

		// 	if(isset($load_parent['parent1']))
		// 	{
		// 		$parent1 = $load_parent['parent1'];

		// 		if(isset($load_parent['parent2']))
		// 		{
		// 			$parent2 = $load_parent['parent2'];

		// 			if(isset($load_parent['parent3']))
		// 			{
		// 				\dash\notif::error(T_("Can not choose this category as parent of another category"), 'parent');
		// 				return false;
		// 			}
		// 			else
		// 			{
		// 				$parent3 = $data['parent'];
		// 			}
		// 		}
		// 		else
		// 		{
		// 			$parent2 = $data['parent'];
		// 		}
		// 	}
		// 	else
		// 	{
		// 		$parent1 = $data['parent'];
		// 	}
		// }
		// else
		// {
		// 	if($_id && is_numeric($_id))
		// 	{
		// 		$load_current = \lib\app\category\get::inline_get($_id);
		// 		if(isset($load_current['parent1'])) $parent1 = $load_current['parent1'];
		// 		if(isset($load_current['parent2'])) $parent2 = $load_current['parent2'];
		// 		if(isset($load_current['parent3'])) $parent3 = $load_current['parent3'];
		// 	}
		// }

		// if($_id && is_numeric($_id))
		// {
		// 	$have_child = \lib\db\productcategory\get::have_child($_id);
		// 	if($have_child)
		// 	{
		// 		$is_parent_not_changed = \lib\db\productcategory\get::is_parent_not_changed($_id, $parent1, $parent2, $parent3);
		// 		if(!$is_parent_not_changed)
		// 		{
		// 			\dash\notif::error(T_("This category have some child and you can not change parent of it"), 'parent');
		// 			return false;
		// 		}
		// 	}

		// 	if($parent1 && floatval($parent1) === floatval($_id))
		// 	{
		// 		\dash\notif::error(T_("Cannot set option as self parent"), 'parent');
		// 		return false;
		// 	}

		// 	if($parent2 && floatval($parent2) === floatval($_id))
		// 	{
		// 		\dash\notif::error(T_("Cannot set option as self parent"), 'parent');
		// 		return false;
		// 	}

		// 	if($parent3 && floatval($parent3) === floatval($_id))
		// 	{
		// 		\dash\notif::error(T_("Cannot set option as self parent"), 'parent');
		// 		return false;
		// 	}
		// }


		// check unique slug
		$check_unique_slug = \lib\db\productcategory\get::check_unique_slug($data['slug']);
		if(isset($check_unique_slug['id']))
		{
			if(floatval($check_unique_slug['id']) === floatval($_id))
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Duplicate slug founded"), 'slug');
				return false;
			}
		}


		// $data['parent1']  = $parent1;
		// $data['parent2']  = $parent2;
		// $data['parent3']  = $parent3;

		unset($data['parent']);

		$properties = [];
		if(isset($_properties) && is_array($_properties))
		{
			foreach ($_properties as $key => $value)
			{
				$my_key = \dash\validate::string_50($key, false);

				if(!$my_key)
				{
					\dash\notif::error(T_("Property Group not set"));
					return false;
				}

				$my_value = \dash\validate::tag($value, false);

				if(!$my_value)
				{
					\dash\notif::error(T_("Property Key must be an array"));
					return false;
				}

				$my_value = array_unique(array_filter($my_value));

				$new_value = [];
				foreach ($my_value as $one_value)
				{
					$new_value[] = ['key' => $one_value];
				}

				$properties[] = ['group' => $my_key, 'key' => $new_value];

			}
		}


		$data['properties'] = $properties;

		return $data;

	}

}
?>