<?php
namespace lib\app\product;


class property
{
	public static function property_cat_name($_category_id, $_saved_category = [])
	{
		if(!is_array($_saved_category))
		{
			$_saved_category = [];
		}

		$old  = array_column($_saved_category, 'group');
		$list = \lib\db\productproperties\get::all_cat_name();
		$list = array_diff($list, $old);

		return $list;
	}


	public static function property_key_name($_category_id, $_saved_category = [])
	{
		if(!is_array($_saved_category))
		{
			$_saved_category = [];
		}

		$old  = array_column($_saved_category, 'key');
		$list = \lib\db\productproperties\get::all_key_name();
		$list = array_diff($list, $old);

		return $list;
	}


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
		if(!is_array($list))
		{
			$list = [];
		}

		$list[] = T_("Length");
		$list[] = T_("Width");
		$list[] = T_("Height");
		$list   = array_unique($list);

		return $list;
	}


	public static function get_count($_id)
	{
		$id = \dash\validate::id($_id, false);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$load_count = \lib\db\productproperties\get::count_product($id);
		if(!is_numeric($load_count))
		{
			$load_count = 0;
		}

		return floatval($load_count);
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
			$load_parent = \lib\app\product\get::get($parent_id);
		}

		$saved_property = \lib\db\productproperties\get::product_property_list($id, $parent_id);

		if(!is_array($saved_property))
		{
			$saved_property = [];
		}

		$result = [];

		$length_name = a(\lib\store::detail('store_data') ,'length_detail','name');
		$mass_name = a(\lib\store::detail('store_data') ,'mass_detail','name');
		$store_currency = \lib\store::currency();



		$result[T_("General property")] =
		[
			'title' => T_("General property"),
			'list' =>
			[

			]
		];

		if(a($load, 'title'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Title"), 'value' => a($load, 'title')]);
		}


		if(a($load, 'title2'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Technical title"), 'value' => a($load, 'title2')]);
		}
		elseif(a($load_parent, 'title2'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Technical title"), 'value' => a($load_parent, 'title2')]);
		}

		if(isset($load['variant_child']) && $load['variant_child'])
		{
			// not showing price
		}
		else
		{
			if(a($load, 'price') && a($load, 'discount'))
			{
				if(a($load, 'price'))
				{
					array_push($result[T_("General property")]['list'], ['key' => T_("List Price"), 'value' => \dash\fit::number(a($load, 'price')). ' '. $store_currency]);
				}

				if(a($load, 'discount'))
				{
					array_push($result[T_("General property")]['list'], ['key' => T_("Discount"), 'value' => \dash\fit::number(a($load, 'discount')). ' '. $store_currency]);
				}
			}

			if(a($load, 'finalprice'))
			{
				array_push($result[T_("General property")]['list'], ['key' => T_("Price"), 'value' => \dash\fit::number(a($load, 'finalprice')). ' '. $store_currency, 'bold' => true]);
			}
		}


		if(a($load, 'optionvalue1') && a($load, 'optionname1'))
		{
			array_push($result[T_("General property")]['list'], ['key' => a($load, 'optionname1'), 'value' => \dash\fit::number(a($load, 'optionvalue1'))]);
		}

		if(a($load, 'optionvalue2') && a($load, 'optionname2'))
		{
			array_push($result[T_("General property")]['list'], ['key' => a($load, 'optionname2'), 'value' => \dash\fit::number(a($load, 'optionvalue2'))]);
		}

		if(a($load, 'optionvalue3') && a($load, 'optionname3'))
		{
			array_push($result[T_("General property")]['list'], ['key' => a($load, 'optionname3'), 'value' => \dash\fit::number(a($load, 'optionvalue3'))]);
		}



		$cat_list = \lib\app\category\get::product_cat($id);

		if(is_array($cat_list) && $cat_list)
		{
			// ok
		}
		else
		{
			if(a($load_parent, 'id'))
			{
				$cat_list = \lib\app\category\get::product_cat($load_parent['id']);
				if(is_array($cat_list) && $cat_list)
				{
					// ok
				}
				else
				{
					$cat_list = [];
				}
			}
			else
			{
				$cat_list = [];
			}
		}

		if($cat_list)
		{
			$cat_list = array_map(['\\lib\\app\\category\\ready', 'row'], $cat_list);

			$cat_url = null;
			$cat_html = [];
			foreach ($cat_list as $category)
			{
				if(\dash\url::content() === 'a')
				{
					$cat_url = \dash\url::here(). '/category/edit?id='. a($category, 'productcategory_id');
				}
				else
				{
					$cat_url = $category['url'];
				}

				$cat_html[] = '<a href="'.$cat_url .'">'. $category['title']. '</a>';

			}

			if($cat_html)
			{
				array_push($result[T_("General property")]['list'], ['key' => T_("Category"), 'value' => implode(T_(","). ' ' , $cat_html)]);
			}
		}


		if(a($load, 'weight'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Weight"), 'value' => \dash\fit::number(\lib\number::down(a($load, 'weight'))) . ' '. $mass_name]);
		}
		elseif(a($load_parent, 'weight'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Weight"), 'value' => \dash\fit::number(\lib\number::down(a($load_parent, 'weight'))) . ' '. $mass_name]);
		}


		if(a($load, 'length'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Length"), 'value' => \dash\fit::number(a($load, 'length')) . ' '. $length_name]);
		}
		elseif(a($load_parent, 'length'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Length"), 'value' => \dash\fit::number(a($load_parent, 'length')) . ' '. $length_name]);
		}


		if(a($load, 'width'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Width"), 'value' => \dash\fit::number(a($load, 'width')) . ' '. $length_name]);
		}
		elseif(a($load_parent, 'width'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Width"), 'value' => \dash\fit::number(a($load_parent, 'width')) . ' '. $length_name]);
		}


		if(a($load, 'height'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Height"), 'value' => \dash\fit::number(a($load, 'height')) . ' '. $length_name]);
		}
		elseif(a($load_parent, 'height'))
		{
			array_push($result[T_("General property")]['list'], ['key' => T_("Height"), 'value' => \dash\fit::number(a($load_parent, 'height')) . ' '. $length_name]);
		}

		$tag_list = \lib\app\tag\get::product_tag($id);

		if(!is_array($tag_list))
		{
			$tag_list = [];
		}

		if($tag_list && $parent_id)
		{
			$tag_list = \lib\app\tag\get::product_tag($parent_id);
			if(!is_array($tag_list))
			{
				$tag_list = [];
			}
		}

		if($tag_list)
		{
			$tag_html = [];
			$tag_url = null;
			foreach ($tag_list as $key => $value)
			{

				if(isset($value['slug']))
				{
					if(\dash\url::content() === 'a')
					{
						if(isset($value['producttag_id']))
						{
							$tag_url = \dash\url::here(). '/products/tag?edit='. $value['producttag_id'];
						}
					}
					else
					{
						$tag_url = \lib\store::url(). '/hashtag/'. $value['slug'];
					}

					$tag_html[] = '<a href="'.$tag_url .'">#'. $value['slug']. '</a>';
				}
			}
			if($tag_html)
			{
				$tag_html = implode(' ', $tag_html);
				array_push($result[T_("General property")]['list'], ['key' => T_("Tag"), 'value' => $tag_html]);
			}
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

		if($cat_list && $_admin)
		{
			$check_duplicate_result = [];
			foreach ($result as $key => $value)
			{
				if(isset($value['title']) && isset($value['list']) && is_array($value['list']))
				{
					foreach ($value['list'] as $k => $v)
					{
						if(isset($v['key']))
						{

							$check_duplicate_result[md5($value['title']. $v['key'])] = $v;
						}
					}
				}
			}

			$productcategory_ids = array_column($cat_list, 'productcategory_id');
			$productcategory_ids = array_filter($productcategory_ids);
			$productcategory_ids = array_unique($productcategory_ids);
			if($productcategory_ids)
			{
				$load_multi_category_property = \lib\db\productcategory\get::multi_properties(implode(',', $productcategory_ids));
				if($load_multi_category_property)
				{
					$all_category_property = [];
					foreach ($load_multi_category_property as $value)
					{
						$category_property = json_decode($value, true);
						if(is_array($category_property))
						{
							$all_category_property = array_merge($all_category_property, $category_property);
						}
					}

					$all_category_property_new = [];
					foreach ($all_category_property as $key => $value)
					{
						if(isset($value['group']) && is_string($value['group']) && isset($value['key']) && is_string($value['key']))
						{
							$all_category_property_new[md5($value['group']. $value['key'])] = $value;
						}
					}


					// $all_category_property = array_values($all_category_property_new);
					foreach ($all_category_property_new as $key => $value)
					{
						if(!isset($check_duplicate_result[$key]))
						{
							if(isset($value['group']) && isset($value['key']))
							{
								if(!isset($result[$value['group']]))
								{
									$result[$value['group']] = ['title' => $value['group'], 'list' => []];
								}
								array_push($result[$value['group']]['list'], ['key' => $value['key'], 'value' => null, 'input' => true]);
							}
						}
					}
				}
			}
		}

		$input_result = [];
		$real_result  = [];

		foreach ($result as $key => $value)
		{
			if(isset($value['list']) && is_array($value['list']))
			{

				foreach ($value['list'] as $k => $v)
				{
					if(a($v, 'input'))
					{
						if(!isset($input_result[$key]['list']))
						{
							$input_result[$key]['title'] = $value['title'];
							$input_result[$key]['list']  = [];
						}

						$input_result[$key]['list'][]  = $v;
					}
					else
					{
						if(!isset($real_result[$key]['list']))
						{
							$real_result[$key]['title'] = $value['title'];
							$real_result[$key]['list']  = [];
						}

						$real_result[$key]['list'][]  = $v;
					}
				}
			}
		}

		if($_admin)
		{
			return
			[
				'saved'    => $real_result,
				'category' => $input_result,
			];
		}
		else
		{
			return $real_result;
		}


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

		\dash\notif::update(T_("Property removed"));
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
					\dash\notif::update(T_("Property set as outstanding"));
					return true;
				}
			}
			else
			{
				if(isset($result['outstanding']) && $result['outstanding'])
				{
					\lib\db\productproperties\update::unset_outstanding($property_id);
					\dash\notif::update(T_("Property remove from outstanding"));
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


	public static function add_multi($_args, $_id)
	{
		foreach ($_args as $key => $value)
		{
			\dash\notif::clean();
			self::add($value, $_id);

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
		$meta    =	['field_title' => ['cat' => T_("Property group")]];
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