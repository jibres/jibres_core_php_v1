<?php
namespace lib\app\product;


class property
{
	public static function all_cat_name()
	{
		$list = \lib\db\productproperties\get::all_cat_name();

		if(is_array($list))
		{
			$list[] = T_("General property");
		}
		else
		{
			$list = [];
		}

		$list = array_filter($list);
		$list = array_unique($list);

		return $list;
	}

	public static function all_key_name()
	{
		$list = \lib\db\productproperties\get::all_key_name();
		return $list;
	}


	public static function all_value_name()
	{
		$list = \lib\db\productproperties\get::all_value_name();
		return $list;
	}

	public static function get_pretty($_id, $_admin = false)
	{
		$id = \dash\validate::id($_id, false);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$load = \lib\app\product\get::get($id);
		if(!$load)
		{
			return false;
		}


		$load_parent = [];
		$parent_id = null;

		if(isset($load['parent']) && $load['parent'])
		{
			$parent_id = $load['parent'];
			$load_parent = \lib\app\product\get::inline_get($parent_id);
		}

		$saved_property = \lib\db\productproperties\get::product_property_list($id, $parent_id);

		if(!is_array($saved_property))
		{
			$saved_property = [];
		}

		$result = [];

		$length_name = \dash\get::index(\lib\store::detail('store_data') ,'length_detail','name');
		$mass_name = \dash\get::index(\lib\store::detail('store_data') ,'mass_detail','name');
		$store_currency = \lib\store::currency();



		$result[T_("General property")] =
		[
			'title' => T_("General property"),
			'list' =>
			[

			]
		];

		if(\dash\get::index($load, 'title'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Title"), 'value' => \dash\get::index($load, 'title')]);
		}


		if(\dash\get::index($load, 'title2'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Technical title"), 'value' => \dash\get::index($load, 'title2')]);
		}
		elseif(\dash\get::index($load_parent, 'title2'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Technical title"), 'value' => \dash\get::index($load_parent, 'title2')]);
		}

		if(\dash\get::index($load, 'finalprice'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Price"), 'value' => \dash\fit::number(\dash\get::index($load, 'finalprice')). ' '. $store_currency]);
		}

		if(\dash\get::index($load, 'discount'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Discount"), 'value' => \dash\fit::number(\dash\get::index($load, 'discount')). ' '. $store_currency]);
		}

		if(\dash\get::index($load, 'optionvalue1') && \dash\get::index($load, 'optionname1'))
		{
			array_push($result[T_("General property")]['list'], ['key' => \dash\get::index($load, 'optionname1'), 'value' => \dash\fit::number(\dash\get::index($load, 'optionvalue1'))]);
		}

		if(\dash\get::index($load, 'optionvalue2') && \dash\get::index($load, 'optionname2'))
		{
			array_push($result[T_("General property")]['list'], ['key' => \dash\get::index($load, 'optionname2'), 'value' => \dash\fit::number(\dash\get::index($load, 'optionvalue2'))]);
		}

		if(\dash\get::index($load, 'optionvalue3') && \dash\get::index($load, 'optionname3'))
		{
			array_push($result[T_("General property")]['list'], ['key' => \dash\get::index($load, 'optionname3'), 'value' => \dash\fit::number(\dash\get::index($load, 'optionvalue3'))]);
		}


		if(\dash\get::index($load, 'cat_id'))
		{
			$load_cat = \lib\app\category\get::inline_get($load['cat_id']);

			if(isset($load_cat['title']))
			{
				$load_cat = \lib\app\category\ready::row($load_cat);
				array_push($result[T_("General property")]['list'], ['key' => T_("Category"), 'value' => $load_cat['title'], 'link' => $load_cat['url']]);
			}
		}
		elseif(\dash\get::index($load_parent, 'cat_id'))
		{
			$load_parent_cat = \lib\app\category\get::inline_get($load_parent['cat_id']);

			if(isset($load_parent_cat['title']))
			{
				$load_parent_cat = \lib\app\category\ready::row($load_parent_cat);
				array_push($result[T_("General property")]['list'], ['key' => T_("Category"), 'value' => $load_parent_cat['title'], 'link' => $load_parent_cat['url']]);
			}
		}

		if(\dash\get::index($load, 'weight'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Weight"), 'value' => \dash\fit::number(\lib\number::down(\dash\get::index($load, 'weight'))) . ' '. $mass_name]);
		}
		elseif(\dash\get::index($load_parent, 'weight'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Weight"), 'value' => \dash\fit::number(\lib\number::down(\dash\get::index($load_parent, 'weight'))) . ' '. $mass_name]);
		}


		if(\dash\get::index($load, 'length'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Length"), 'value' => \dash\fit::number(\dash\get::index($load, 'length')) . ' '. $length_name]);
		}
		elseif(\dash\get::index($load_parent, 'length'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Length"), 'value' => \dash\fit::number(\dash\get::index($load_parent, 'length')) . ' '. $length_name]);
		}


		if(\dash\get::index($load, 'width'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Width"), 'value' => \dash\fit::number(\dash\get::index($load, 'width')) . ' '. $length_name]);
		}
		elseif(\dash\get::index($load_parent, 'width'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Width"), 'value' => \dash\fit::number(\dash\get::index($load_parent, 'width')) . ' '. $length_name]);
		}


		if(\dash\get::index($load, 'height'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Height"), 'value' => \dash\fit::number(\dash\get::index($load, 'height')) . ' '. $length_name]);
		}
		elseif(\dash\get::index($load_parent, 'height'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Height"), 'value' => \dash\fit::number(\dash\get::index($load_parent, 'height')) . ' '. $length_name]);
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

			$result[$value['cat']]['list'][] = ['key' => $value['key'], 'value' => $value['value'], 'id' => $value['id'], 'outstanding' => $value['outstanding']];

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

		$parent_id = null;

		if(isset($load['parent']) && $load['parent'])
		{
			$parent_id = $load['parent'];
		}

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


		$saved_property = \lib\db\productproperties\get::product_property_list($id, $parent_id);

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

	public static function remove($_property_id, $_product_id)
	{
		$product_id = \dash\validate::id($_product_id);
		$property_id = \dash\validate::id($_property_id);

		\lib\db\productproperties\delete::one($property_id, $product_id);

		\dash\notif::ok(T_("Property removed"));
		return true;
	}


	public static function outstanding($_property_id, $_product_id, $_type)
	{
		$product_id = \dash\validate::id($_product_id);
		$property_id = \dash\validate::id($_property_id);

		$result = \lib\db\productproperties\get::one($property_id, $product_id);

		if(isset($result['id']))
		{
			if($_type === 'set')
			{
				if(isset($result['outstanding']) && $result['outstanding'])
				{
					\dash\notif::info(T_("This property already set as outstanding"));
					return true;
				}
				else
				{
					\lib\db\productproperties\update::set_outstanding($property_id);
					\dash\notif::ok(T_("Property set as outstanding"));
					return true;
				}
			}
			else
			{
				if(isset($result['outstanding']) && $result['outstanding'])
				{
					\lib\db\productproperties\update::unset_outstanding($property_id);
					\dash\notif::ok(T_("Property remove from outstanding"));
					return true;
				}
				else
				{
					\dash\notif::info(T_("This property is not an outstanding property"));
					return true;
				}
			}
		}
		else
		{
			\dash\notif::error(T_("Property not found"));
			return false;
		}

	}

	public static function add($_args, $_id, $_edit_id = null)
	{
		$condition =
		[
			'cat'         => 'string_100',
			'key'         => 'string_100',
			'value'       => 'string_1000',
			'outstanding' => 'bit',
		];

		$_edit_id = \dash\validate::id($_edit_id, false);

		$require = ['cat', 'key', 'value'];
		$meta    =	[];
		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);
		$id      = \dash\validate::id($_id);

		$load_product = \lib\app\product\get::inline_get($id);
		if(!$load_product)
		{
			return false;
		}

		$check_duplicate = \lib\db\productproperties\get::check_duplicate($data['cat'], $data['key'], $data['value'], $id);

		if($check_duplicate)
		{
			if($_edit_id && isset($check_duplicate['id']) && floatval($_edit_id) === floatval($check_duplicate['id']))
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Duplicate property founded"));
				return false;
			}
		}

		if($_edit_id)
		{
			$check_ok = \lib\db\productproperties\get::one($_edit_id, $id);
			if(!isset($check_ok['id']))
			{
				\dash\notif::error(T_("Invalid property id"));
				return false;
			}

			$update =
			[
				'cat' => $data['cat'],
				'key' => $data['key'],
				'value' => $data['value'],
				'datemodified' => date("Y-m-d H:i:s"),

			];
			\lib\db\productproperties\update::record($update, $_edit_id);
			\dash\notif::ok(T_("Property successfully edited"));

		}
		else
		{

			$insert =
			[
				'product_id' => $id,
				'cat' => $data['cat'],
				'key' => $data['key'],
				'value' => $data['value'],
				'datecreated' => date("Y-m-d H:i:s"),

			];
			\lib\db\productproperties\insert::new_record($insert);
			\dash\notif::ok(T_("Property successfully added"));
		}


		return true;



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

		$load = \lib\app\product\get::inline_get($data['id']);

		if(!$load)
		{
			return false;
		}

		$parent_id = null;

		$save_on_id = $data['id'];
		if(isset($load['parent']) && $load['parent'])
		{
			$parent_id  = $load['parent'];
			$save_on_id = $parent_id;
		}
		// $new_property = array_values($new_property);

		$saved_property = \lib\db\productproperties\get::product_property_list($data['id'], $parent_id);

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
				$must_insert[$key]['product_id']  = $save_on_id;
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