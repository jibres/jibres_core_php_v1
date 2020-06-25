<?php
namespace lib\app\product;


class property
{
	public static function get_pretty($_id)
	{
		$id = \dash\validate::id($_id, false);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$load = \lib\app\product\get::inline_get($id);
		if(!$load)
		{
			return false;
		}

		$saved_property = \lib\db\productproperties\get::product_property_list($id);

		if(!is_array($saved_property))
		{
			$saved_property = [];
		}

		$result = [];

		$length_name = \dash\get::index(\lib\store::detail('store_data') ,'length_detail','name');
		$mass_name = \dash\get::index(\lib\store::detail('store_data') ,'mass_detail','name');


		$result[T_("General property")] =
		[
			'title' => T_("General property"),
			'list' =>
			[

			]
		];

		if(\dash\get::index($load, 'weight'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Weight"), 'value' => \dash\fit::number(\dash\get::index($load, 'weight')) . ' '. $mass_name]);
		}

		if(\dash\get::index($load, 'length'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Weight"), 'value' => \dash\fit::number(\dash\get::index($load, 'length')) . ' '. $length_name]);
		}


		if(\dash\get::index($load, 'width'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Weight"), 'value' => \dash\fit::number(\dash\get::index($load, 'width')) . ' '. $length_name]);
		}


		if(\dash\get::index($load, 'height'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Weight"), 'value' => \dash\fit::number(\dash\get::index($load, 'height')) . ' '. $length_name]);
		}




		foreach ($saved_property as $key => $value)
		{
			if(!isset($value['cat']) || !isset($value['key']) || !isset($value['value']))
			{
				continue;
			}

			if(!isset($result[$value['cat']]))
			{
				$result[$value['cat']] = ['title' => $value['cat'], 'list' => []];
			}

			$result[$value['cat']]['list'][] = ['key' => $value['key'], 'value' => $value['value']];

		}


		return $result;

	}

	public static function get($_id)
	{
		$id = \dash\validate::id($_id, false);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}


		$load = \lib\app\product\get::inline_get($id);

		$category_property = [];

		if(isset($load['cat_id']) && $load['cat_id'])
		{
			$cat_id   = $load['cat_id'];
			$load_parent_property = \lib\app\category\get::parent_property($cat_id);
			if($load_parent_property && is_array($load_parent_property))
			{
				foreach ($load_parent_property as $key => $value)
				{
					if(isset($value['properties']) && is_array($value['properties']))
					{
						$category_property = array_merge($category_property, $value['properties']);
					}
				}
			}

			$load_cat = \lib\app\category\get::get($cat_id);

			if(isset($load_cat['properties']) && $load_cat['properties'] && is_array($load_cat['properties']))
			{
				$category_property = array_merge($category_property, $load_cat['properties']);
			}

		}

		$result = [];

		foreach ($category_property as $value)
		{
			$temp = [];
			$group = null;
			if(isset($value['group']))
			{
				$temp['group'] = $value['group'];
				$group = $value['group'];
			}

			if(!$group)
			{
				continue;
			}

			if(isset($value['key']) && is_array($value['key']))
			{
				foreach ($value['key'] as $key)
				{
					if(isset($key['key']))
					{
						$my_key = md5($group). '_'. md5($key['key']);

						$result[$my_key] = ['cat' => $group, 'key' => $key, 'value' => null, 'from_category' => true];
					}
				}
			}

		}


		$saved_property = \lib\db\productproperties\get::product_property_list($id);

		if(!is_array($saved_property))
		{
			$saved_property = [];
		}

		foreach ($saved_property as $key => $value)
		{
			$my_key = md5($value['cat']). '_'. md5($value['key']);
			if(isset($result[$my_key]))
			{
				$result[$my_key]['value'] = $value['value'];
			}
			else
			{
				$result[] = ['cat' => $value['cat'], 'key' => ['key' => $value['key']], 'value' => $value['value']];
			}

		}

		$result = array_values($result);


		return $result;
	}


	public static function set($_property, $_id)
	{
		$condition =
		[
			'property' => ['cat' => 'string_100','key' => 'string_100','value' => 'string_1000',],
			'id'       => 'id',
		];

		$args =
		[
			'property' => $_property,
			'id'       => $_id,
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input($args, $condition, $require, $meta);

		$new_property   = [];
		$have_duplicate = false;

		$must_insert    = [];
		$must_update    = [];
		$must_remove    = [];

		foreach ($data['property'] as $key => $value)
		{
			$my_key = md5($value['cat']). '_'. md5($value['key']). '_'. md5($value['value']);
			if(isset($new_property[$my_key]))
			{
				$have_duplicate = true;
				continue;
			}

			if(!$value['cat'] || !$value['key'] || !$value['value'])
			{
				continue;
			}


			$new_property[$my_key] = $value;
		}

		if($have_duplicate)
		{
			\dash\notif::warn(T_("Some detail was duplicate. We remove duplicate items"));
		}

		// $new_property = array_values($new_property);

		$saved_property = \lib\db\productproperties\get::product_property_list($data['id']);

		if(!is_array($saved_property))
		{
			$saved_property = [];
		}

		if(!$saved_property)
		{
			$must_insert = $new_property;
		}
		else
		{
			$check_saved_property = [];

			foreach ($saved_property as $key => $value)
			{
				$my_key = md5($value['cat']). '_'. md5($value['key']). '_'. md5($value['value']);

				$check_saved_property[$my_key] = $value;

				if(isset($new_property[$my_key]))
				{
					// maybe need to update sort
				}
				else
				{
					$must_remove[] = $value['id'];
				}
			}

			foreach ($new_property as $key => $value)
			{
				$my_key = md5($value['cat']). '_'. md5($value['key']). '_'. md5($value['value']);
				if(isset($check_saved_property[$my_key]))
				{
					// maybe need to update sort
				}
				else
				{
					$must_insert[] = $value;
				}
			}
		}

		if(!empty($must_insert))
		{
			foreach ($must_insert as $key => $value)
			{
				$must_insert[$key]['product_id']  = $data['id'];
				$must_insert[$key]['datecreated'] = date("Y-m-d H:i:s");
			}

			\lib\db\productproperties\insert::multi_insert($must_insert);
		}

		if(!empty($must_remove))
		{
			\lib\db\productproperties\delete::multi(implode(',', $must_remove));
		}

		if(empty($must_remove) && empty($must_insert))
		{
			\dash\notif::info(T_("Product property saved without chnage"));
		}
		else
		{
			\dash\notif::ok(T_("Product property saved"));
		}

		return true;

	}
}
?>