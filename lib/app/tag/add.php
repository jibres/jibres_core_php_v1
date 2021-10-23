<?php
namespace lib\app\tag;


class add
{

	public static function first_level($_id)
	{
		$load = \lib\app\tag\get::inline_get($_id);
		if($load)
		{
			$sort = floatval(\lib\db\productcategory\get::last_sort()) + 1;
			\lib\db\productcategory\update::set_first_level($_id, $sort);
		}
	}

	public static function apply_to_all($_args)
	{
		$condition =
		[
			'tag'      => 'string_30',
		];

		$require = ['tag'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$tag_id = null;

		$check_duplicate = \lib\db\productcategory\get::check_duplicate_title($data['tag']);

		if(isset($check_duplicate['id']))
		{
			$tag_id = $check_duplicate['id'];
		}
		else
		{
			$insert_args = \lib\app\tag\check::variable(['title' => $data['tag']]);

			unset($insert_args['properties']);

			if(!$insert_args || !\dash\engine\process::status())
			{
				return false;
			}


			$tag_id = \lib\db\productcategory\insert::new_record($insert_args);
		}

		if(!$tag_id)
		{
			\dash\notif::error(T_("Can not add tag"));
			return false;
		}

		\lib\db\productcategory\insert::apply_to_all_product($tag_id);

		\dash\notif::ok(T_("Tag added to all prodcut"));
		return true;
	}

	public static function property($_args, $_id)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('manageProductCategory'))
		{
			return false;
		}

		$_id = \dash\validate::id($_id);
		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		$condition =
		[
			'cat' => 'string_50',
			'key' => 'string_50',

		];

		$require = ['cat', 'key'];

		$meta =
		[
			'field_title' => ['cat' => T_("Group"), 'key' => T_("Type")],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$get_category = \lib\db\productcategory\get::one($_id);

		if(!isset($get_category['id']))
		{
			\dash\notif::error(T_("Invalid tag id"), 'tag');
			return false;
		}

		$properties = [];
		if(isset($get_category['properties']))
		{
			if($get_category['properties'])
			{
				if(is_array($get_category['properties']))
				{
					$properties = $get_category['properties'];
				}
				elseif(is_string($get_category['properties']))
				{
					$properties = json_decode($get_category['properties'], true);

					if(!is_array($properties))
					{
						$properties = [];
					}
				}
			}
		}

		$new_property = [];

		foreach ($properties as $value)
		{
			$key   = null;
			$group = null;

			if(isset($value['group']))
			{
				$group = $value['group'];
			}

			if(isset($value['key']))
			{
				$key = $value['key'];
			}

			$new_property[md5($group. $key)] = ['group' => $group, 'key' => $key];
		}

		if(isset($new_property[md5($data['cat']. $data['key'])]))
		{
			\dash\notif::error(T_("Duplicate item founded"));
			return false;
		}
		else
		{
			$new_property[md5($data['cat']. $data['key'])] = ['group' => $data['cat'], 'key' => $data['key']];
		}


		$new_property = array_values($new_property);
		$new_property = json_encode($new_property, JSON_UNESCAPED_UNICODE);

		\lib\db\productcategory\update::record(['properties' => $new_property], $_id);

		\dash\notif::ok(T_("General property saved"));
		return true;
	}


	public static function remove_property($_index, $_id)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('manageProductCategory'))
		{
			return false;
		}

		$_id = \dash\validate::id($_id);
		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		$_index = \dash\validate::smallint($_index);


		$get_category = \lib\db\productcategory\get::one($_id);

		if(!isset($get_category['id']))
		{
			\dash\notif::error(T_("Invalid tag id"), 'tag');
			return false;
		}

		$properties = [];
		if(isset($get_category['properties']))
		{
			if($get_category['properties'])
			{
				if(is_array($get_category['properties']))
				{
					$properties = $get_category['properties'];
				}
				elseif(is_string($get_category['properties']))
				{
					$properties = json_decode($get_category['properties'], true);

					if(!is_array($properties))
					{
						$properties = [];
					}
				}
			}
		}

		if(!isset($properties[$_index]))
		{
			\dash\notif::error(T_("Property not found"));
			return false;
		}
		else
		{
			unset($properties[$_index]);
		}


		$properties = array_values($properties);
		$properties = json_encode($properties, JSON_UNESCAPED_UNICODE);

		\lib\db\productcategory\update::record(['properties' => $properties], $_id);

		\dash\notif::ok(T_("General property removed"));
		return true;
	}




	public static function add($_args)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('manageProductCategory'))
		{
			return false;
		}



		$args = \lib\app\tag\check::variable($_args);
		if(!$args)
		{
			return false;
		}

		unset($args['properties']);

		$args['datecreated']   = date("Y-m-d H:i:s");
		$args['status']        = 'enable';
		$args['language']      = \dash\language::current();
		$args['firstlevel'] = $args['firstlevel'];
		$args['showonwebsite'] = $args['showonwebsite'];
		$args['sort']          = floatval(\lib\db\productcategory\get::last_sort()) + 1;


		$id = \lib\db\productcategory\insert::new_record($args);
		if(!$id)
		{
			\dash\log::set('productCategoryDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		\dash\notif::ok(T_("Category successfully added"));

		// create sitemap
		\dash\utility\sitemap::tags($id);

		$result       = [];
		$result['id'] = $id;
		return $result;
	}



	public static function product_cat_plus($_tag_id, $_product_id)
	{
		$product_detail = \lib\app\product\get::get($_product_id);
		if(!$product_detail)
		{
			return false;
		}

		$load_cat = \lib\app\tag\get::get($_tag_id);
		if(!$load_cat)
		{
			return false;
		}


		$check_product_have_cat = \lib\db\productcategoryusage\get::check_product_have_cat($_product_id, $_tag_id);

		if($check_product_have_cat)
		{
			\dash\notif::warn(T_("This product have this tag"));
			return true;
		}
		else
		{
			$insert =
			[
				'productcategory_id' => $_tag_id,
				'product_id'         => $_product_id,
			];
			\lib\db\productcategoryusage\insert::new_record($insert);
			\dash\notif::ok(T_("Category added to this product"));
			return true;
		}

	}



	public static function product_cat($_cat, $_product_id)
	{

		if(!$_cat)
		{
			$have_old_cat = \lib\db\productcategoryusage\get::usage($_product_id);
			if($have_old_cat)
			{
				\dash\temp::set('productHasChange', true);
				\lib\db\productcategoryusage\delete::hard_delete_all_product_cat($_product_id);
			}
			return false;
		}

		$have_term_to_save_log = false;

		if(is_string($_cat))
		{
			$cat = $_cat;
			$cat = explode(',', $cat);
		}
		elseif(is_array($_cat))
		{
			$cat = $_cat;
		}
		else
		{
			return false;
		}

		$cat = array_filter($cat);
		$cat = array_unique($cat);
		if(!$cat)
		{
			return false;
		}

		foreach ($cat as $key => $value)
		{
			if(!is_string($value) && !is_numeric($value))
			{
				\dash\notif::error(T_("Invalid cat format"), 'cat');
				return false;
			}
		}


		$check_exist_cat = \lib\db\productcategory\get::mulit_title($cat);

		$all_cats_id = [];

		$must_insert_cat = $cat;

		if(is_array($check_exist_cat))
		{
			$check_exist_cat = array_column($check_exist_cat, 'title', 'id');
			$check_exist_cat = array_filter($check_exist_cat);
			$check_exist_cat = array_unique($check_exist_cat);

			foreach ($check_exist_cat as $key => $value)
			{

				if(isset($value) && in_array($value, $cat))
				{
					unset($cat[array_search($value, $cat)]);
					unset($must_insert_cat[array_search($value, $must_insert_cat)]);
				}

				array_push($all_cats_id, intval($key));
			}
		}

		$must_insert_cat = array_filter($must_insert_cat);
		$must_insert_cat = array_unique($must_insert_cat);

		if(!empty($must_insert_cat))
		{
			$multi_insert_cat = [];
			foreach ($must_insert_cat as $key => $value)
			{
				if(mb_strlen($value) > 50)
				{
					\dash\notif::error(T_("Category is too long!"), 'cat');
					return false;
				}

				$slug = \dash\validate::slug($value, false);

				$multi_insert_cat[] =
				[
					'title'         => $value,
					'slug'          => $slug,
					'status'        => 'enable',
					'showonwebsite' => 1,
					// 'creator'  => \dash\user::id(),
					// 'language' => \dash\language::current(),
				];
			}
			$have_term_to_save_log = true;
			$first_id    = \lib\db\productcategory\insert::multi_insert($multi_insert_cat);
			$all_cats_id = array_merge($all_cats_id, \dash\db\config::multi_insert_id($multi_insert_cat, $first_id));
		}

		$category_id = $all_cats_id;

		$get_old_product_cat = \lib\db\productcategoryusage\get::usage($_product_id);

		$must_insert = [];
		$must_remove = [];

		if(empty($get_old_product_cat))
		{
			$must_insert = $category_id;
		}
		else
		{
			$old_category_id = array_column($get_old_product_cat, 'productcategory_id');
			$old_category_id = array_map('floatval', $old_category_id);
			$must_insert = array_diff($category_id, $old_category_id);
			$must_remove = array_diff($old_category_id, $category_id);
		}

		if(!empty($must_insert))
		{
			if(count($must_insert) > 20)
			{
				\dash\notif::error(T_("You can set maximum 20 cat to product"), 'cat');
				return false;
			}

			$insert_multi = [];
			foreach ($must_insert as $key => $value)
			{
				$insert_multi[] =
				[
					'productcategory_id' => $value,
					'product_id'    => $_product_id,

				];
			}
			if(!empty($insert_multi))
			{
				$have_term_to_save_log = true;
				\lib\db\productcategoryusage\insert::multi_insert($insert_multi);
			}
		}

		if(!empty($must_remove))
		{
			$have_term_to_save_log = true;
			$must_remove = array_filter($must_remove);
			$must_remove = array_unique($must_remove);

			$must_remove = implode(',', $must_remove);
			\lib\db\productcategoryusage\delete::hard_delete_product_category($must_remove, $_product_id);
		}


		if($have_term_to_save_log)
		{
			\dash\temp::set('productHasChange', true);
		}

		return true;

	}




}
?>