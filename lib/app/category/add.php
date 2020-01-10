<?php
namespace lib\app\category;


class add
{

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

		$args = \lib\app\category\check::variable();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_category_title = \lib\db\productcategory\get::by_title($args['title']);

		if(isset($get_category_title['id']))
		{
			\dash\notif::error(T_("Duplicate category founded"), 'category');
			return false;
		}

		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['slug']        = \dash\utility\filter::slug($args['title'], null, 'persian');
		$args['language']    = \dash\language::current();

		$id = \lib\db\productcategory\insert::new_record($args);
		if(!$id)
		{
			\dash\log::set('productCategoryDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		\dash\notif::ok(T_("Category successfully added"));


		$result       = [];
		$result['id'] = $id;
		return $result;
	}



}
?>