<?php
namespace lib\app\product;


class category
{
	public static $debug = true;


	public static function check_add($_category)
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		$get_category_title = \lib\db\productcategory\get::by_title($_category);
		if(isset($get_category_title['id']))
		{
			return $get_category_title;
		}

		if(!self::check_title($_category))
		{
			return false;
		}

		$args =
		[
			'title'       => $_category,
			'datecreated' => date("Y-m-d H:i:s"),
			'slug'        => \dash\utility\filter::slug($_category, null, 'persian'),
			'language'    => \dash\language::current(),
		];

		$id = \lib\db\productcategory\insert::new_record($args);

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


	private static function check_title($_title)
	{
		$title = $_title;
		if(!is_string($title))
		{
			\dash\notif::error(T_("Format error!"));
			return false;
		}

		if(!$title && $title !== '0')
		{
			\dash\notif::error(T_("Plese fill the category name"), 'category');
			return false;
		}

		if(mb_strlen($title) > 100)
		{
			\dash\notif::error(T_("Category name is too large!"), 'category');
			return false;
		}

		return true;
	}


	private static function check($_id = null)
	{
		$title = \dash\app::request('title');
		if(!is_string($title))
		{
			\dash\notif::error(T_("Format error!"));
			return false;
		}

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

		$desc = \dash\app::request('desc');
		if(!is_string($desc))
		{
			\dash\notif::error(T_("Format error!"));
			return false;
		}

		if(mb_strlen($desc) > 10000)
		{
			if(self::$debug) \dash\notif::error(T_("Category description is too large!"), 'category');
			return false;
		}

		$file = \dash\app::request('file');

		$args          = [];
		$args['title'] = $title;
		$args['desc']  = $desc;
		$args['file']  = $file;

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

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		\dash\app::variable($_args);

		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_category_title = \lib\db\productcategory\get::by_title($args['title']);

		if(isset($get_category_title['id']))
		{
			if(self::$debug) \dash\notif::error(T_("Duplicate category founded"), 'category');
			return false;
		}

		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['slug']        = \dash\utility\filter::slug($slug, null, 'persian');
		$args['language']    = \dash\language::current();

		$id = \lib\db\productcategory\insert::new_record($args);
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
		$result['id'] = $id;
		return $result;
	}

	public static function remove_file($_id)
	{
		$load = self::inline_get($_id);
		if($load)
		{
			\dash\upload\category::remove($_id);
			\lib\db\productcategory\update::unset_file($_id);
		}
	}


	public static function remove($_args, $_id)
	{
		if(!\dash\permission::check('productCategoryDelete'))
		{
			return false;
		}

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
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

		$count_product = \lib\db\productcategory\get::get_count_product($id);
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

				\lib\db\products\category::update_all_product_by_category($new_category_id, $new_category_title, $old_category_id);
			}
			else
			{
				\lib\db\products\category::update_all_product_by_category(null, null, $old_category_id);
			}
		}

		\dash\log::set('productCategoryDeleted', ['old' => $load]);

		\lib\db\productcategory\delete::delete($id);
		if(self::$debug)
		{
			\dash\notif::ok(T_("Category successfully removed"));
		}
		return true;
	}


	public static function inline_get($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$load = \lib\db\productcategory\get::one($_id);
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


		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$load = \lib\db\productcategory\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$load['count'] = \lib\db\productcategory\get::get_count_product($_id);
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

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		\dash\app::variable($_args);

		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$args = self::check($_id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_category = \lib\db\productcategory\get::one($_id);

		if(isset($get_category['id']) && isset($get_category['title']) && $get_category['title'] == $args['title'])
		{
			if(intval($get_category['id']) === intval($_id))
			{
				// nothing
			}
			else
			{
				if(self::$debug) \dash\notif::error(T_("Duplicate category founded"), 'category');
				return false;
			}
		}


		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('desc')) unset($args['desc']);
		if(!\dash\app::isset_request('file')) unset($args['file']);


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
				$update = \lib\db\productcategory\update::record($args, $_id);

				if($update)
				{

					\dash\log::set('productCategoryUpdated', ['old' => $get_category, 'change' => $args]);

					if(array_key_exists('title', $args))
					{
						// update all product by this category
						\lib\db\products\category::update_all_product_category_title($_id, $args['title']);
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

		if($_string)
		{
			$_string = \dash\safe::forQueryString($_string);
			if(mb_strlen($_string) > 50)
			{
				$_string = null;
			}
		}


		$result = \lib\db\productcategory\get::list($_string);

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
				// case 'id':
				// 	$result[$key] = \dash\coding::encode($value);
				// 	break;
				case 'file':
					$result[$key] = \lib\filepath::fix($value);;

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