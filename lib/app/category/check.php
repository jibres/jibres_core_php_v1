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