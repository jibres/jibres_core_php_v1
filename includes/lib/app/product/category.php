<?php
namespace lib\app\product;


class category
{
	public static $debug = true;


	public static function check_add($_category)
	{
		$get_category_title = \lib\db\productcategory\db::get_by_title(\lib\store::id(), $_category);
		if(isset($get_category_title['id']))
		{
			return $get_category_title;
		}

		$args =
		[
			'title'       => $_category,
			'store_id'    => \lib\store::id(),
			'datecreated' => date("Y-m-d H:i:s"),
			'slug'        => \dash\utility\filter::slug($_category, null, 'persian'),
			'language'    => \dash\language::current(),
		];

		$id = \lib\db\productcategory\db::insert($args);

		if(!$id)
		{
			\dash\log::set('productCategoryDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		$result          = [];
		$result['id']    = $id;
		$result['title'] = $_category;

		return $result;
	}


	private static function check($_id = null)
	{
		$title = \dash\app::request('title');
		if(!$title && $title !== '0')
		{
			if(self::$debug) \dash\notif::error(T_("Plese fill the category name"), 'category');
			return false;
		}

		if(mb_strlen($title) > 100)
		{
			if(self::$debug) \dash\notif::error(T_("Category name is too large!"), 'category');
			return false;
		}

		$int = \dash\app::request('int') ? 1 : null;

		$default = \dash\app::request('categorydefault') ? 1 : null;

		$maxsale = \dash\app::request('maxsale');
		if($maxsale && !is_numeric($maxsale))
		{
			if(self::$debug) \dash\notif::error(T_("Plese set the max sale as a number"), 'maxsale');
			return false;
		}

		if($maxsale)
		{
			$maxsale = abs(intval($maxsale));
			if(\dash\utility\filter::is_larger($maxsale, 999999999))
			{
				if(self::$debug) \dash\notif::error(T_("Max sale is out of range"), 'maxsale');
				return false;
			}
		}

		$args            = [];
		$args['title']   = $title;
		$args['int']     = $int;
		$args['default'] = $default;
		$args['maxsale'] = $maxsale;
		return $args;

	}


	public static function add($_args)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('productCategoryListAdd'))
		{
			return false;
		}

		\dash\app::variable($_args);

		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_category_title = \lib\db\productcategory\db::get_by_title(\lib\store::id(), $args['title']);

		if(isset($get_category_title['id']))
		{
			if(self::$debug) \dash\notif::error(T_("Duplicate category founded"), 'category');
			return false;
		}

		$args['store_id']    = \lib\store::id();
		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['slug']        = \dash\utility\filter::slug($slug, null, 'persian');
		$args['language']    = \dash\language::current();

		$id = \lib\db\productcategory\db::insert($args);
		if(!$id)
		{
			\dash\log::set('productCategoryDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		if(self::$debug)
		{
			\dash\notif::ok(T_("Category successfully added"));
		}

		$result       = [];
		$result['id'] = \dash\coding::encode($id);
		return $result;
	}


	public static function remove($_args, $_id)
	{
		if(!\dash\permission::check('productCategoryDelete'))
		{
			return false;
		}

		\dash\app::variable($_args);

		$load = self::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$id = \dash\coding::decode($_id);

		$count_product = \lib\db\products\category::get_count_category(\lib\store::id(), $id);
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
				$check = self::inline_get($category);
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

				\lib\db\products\category::update_all_product_by_category(\lib\store::id(), $new_category_id, $new_category_title, $old_category_id);
			}
			else
			{
				\lib\db\products\category::update_all_product_by_category(\lib\store::id(), null, null, $old_category_id);
			}
		}

		\dash\log::set('productCategoryDeleted', ['old' => $load]);

		\lib\db\productcategory\db::delete($id);
		if(self::$debug)
		{
			\dash\notif::ok(T_("Category successfully removed"));
		}
		return true;
	}


	public static function inline_get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$load = \lib\db\productcategory\db::get_one(\lib\store::id(), $id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		return $load;
	}


	public static function get($_id)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\dash\permission::access('productCategoryListView');

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$load = \lib\db\productcategory\db::get_one(\lib\store::id(), $id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$load['count'] = \lib\db\products\category::get_count_category(\lib\store::id(), $id);
		$load = self::ready($load);
		return $load;
	}



	public static function edit($_args, $_id)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('productCategoryListEdit'))
		{
			return false;
		}

		\dash\app::variable($_args);

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_category = \lib\db\productcategory\db::get_one(\lib\store::id(), $id);

		if(isset($get_category['id']) && isset($get_category['title']) && $get_category['title'] == $args['title'])
		{
			if(intval($get_category['id']) === intval($id))
			{
				// nothing
			}
			else
			{
				if(self::$debug) \dash\notif::error(T_("Duplicate category founded"), 'category');
				return false;
			}
		}

		if($args['default'])
		{
			\lib\db\productcategory\db::set_all_default_as_null(\lib\store::id());
		}

		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('int')) unset($args['int']);
		if(!\dash\app::isset_request('default')) unset($args['default']);
		if(!\dash\app::isset_request('maxsale')) unset($args['maxsale']);

		if(!empty($args))
		{
			foreach ($get_category as $field => $value)
			{
				if(array_key_exists($field, $args) && $args[$field] == $value)
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
				$update = \lib\db\productcategory\db::update($args, $id);

				if($update)
				{

					\dash\log::set('productCategoryUpdated', ['old' => $get_category, 'change' => $args]);

					if(array_key_exists('title', $args))
					{
						// update all product by this category
						\lib\db\products\category::update_all_product_category_title(\lib\store::id(), $id, $args['title']);
					}

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
			\dash\notif::error(T_("No data received!"));
			return false;
		}
	}


	public static function list($_string = null, $_args = [])
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\dash\permission::access('productCategoryListView');


		$result = \lib\db\productcategory\db::get_list(\lib\store::id());

		$temp            = [];


		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}


	private static function ready($_data)
	{
		if(!is_array($_data))
		{
			return false;
		}

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
					$result[$key] = \dash\coding::encode($value);
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}

}
?>