<?php
namespace lib\app\product;


class cat
{
	public static $debug = true;

	public static $sort_field =
	[
		'title',
		'type',
		'slug',
		'url',

	];



	public static function check_add($_cat)
	{
		if(!$_cat && $_cat !== '0')
		{
			return;
		}

		$list = self::list();
		if(!array_key_exists($_cat, $list))
		{
			self::add(['title' => $_cat]);
		}
		return;
	}


	private static function check()
	{
		$title = \dash\app::request('title');
		if(!$title && $title !== '0')
		{
			if(self::$debug) \dash\notif::error(T_("Plese fill the cat name"), 'cat');
			return false;
		}

		if(mb_strlen($title) > 100)
		{
			if(self::$debug) \dash\notif::error(T_("Category name is too large!"), 'cat');
			return false;
		}

		$slug = \dash\app::request('slug');
		if(!$slug)
		{
			$slug = \dash\utility\filter::slug($title);
			if(mb_strlen($slug) > 100)
			{
				\dash\notif::error(T_("Please set the title or slug less than 100 character"), ['element' => ['slug', 'title']]);
				return false;
			}
		}

		$url = \dash\app::request('url');
		if($url && mb_strlen($url) > 1000)
		{
			\dash\notif::error(T_("Please set the url less than 1000 character"), 'url');
			return false;
		}

		// $order = \dash\app::request('order');
		// $count = \dash\app::request('count');
		// $parent = \dash\app::request('parent');

		$desc = \dash\app::request('desc');
		$file = \dash\app::request('file');
		$site = \dash\app::request('site') ? 'yes' : 'no';
		$isdefault = \dash\app::request('isdefault') ? 1 : null;


		$valuetype = \dash\app::request('valuetype');
		if($valuetype && !in_array($valuetype, ['decimal', 'integer']))
		{
			if(self::$debug) \dash\notif::error(T_("Invalid valuetype of cat"), 'valuetype');
			return false;
		}

		$maxsale = \dash\app::request('maxsale');
		if($maxsale && !is_numeric($maxsale))
		{
			if(self::$debug) \dash\notif::error(T_("Plese set the max sale as a number"), 'maxsale');
			return false;
		}

		if($maxsale)
		{
			$maxsale = abs(intval($maxsale));
			if($maxsale > 1E+9)
			{
				if(self::$debug) \dash\notif::error(T_("Max sale is out of range"), 'maxsale');
				return false;
			}
		}

		$args              = [];
		$meta              = [];
		$meta['maxsale']   = $maxsale;

		if($meta)
		{
			$meta              = json_encode($meta, JSON_UNESCAPED_UNICODE);
			$args['meta']      = $meta;
		}

		$args['slug']      = $slug;
		$args['type']      = 'cat';
		$args['title']     = $title;

		if($file)
		{
			$args['file']      = $file;
		}
		$args['desc']      = $desc;
		$args['valuetype'] = $valuetype;
		$args['isdefault'] = $isdefault;

		return $args;

	}


		/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	public static function get($_id, $_option = [])
	{

		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User id not found"));
			return false;
		}

		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store id not found"));
			return false;
		}


		$id = $_id;
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			\dash\notif::error(T_("Id not set"));
			return false;
		}

		$result = \lib\db\productterms::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

		if(!$result)
		{
			\dash\notif::error(T_("Can not access to load this term details"));
			return false;
		}

		$result = self::ready($result);

		return $result;
	}


	public static function add($_args)
	{
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

		$args['creator'] = \dash\user::id();
		$args['store_id'] = \lib\store::id();

		$check =
		[
			'title'    => $args['title'],
			'type'     => $args['type'],
			'store_id' => \lib\store::id(),
			'limit'    => 1,
		];

		$check_duplicate = \lib\db\productterms::get($check);

		if(isset($check_duplicate['id']))
		{
			if(self::$debug) \dash\notif::error(T_("Duplicate cat founded"), 'cat');
			return false;
		}

		if(isset($args['default']) && $args['default'])
		{
			\lib\db\productterms::update_where(['default' => null], ['store_id' => \lib\store::id(), 'type' => 'cat']);
		}

		$result = \lib\db\productterms::insert($args);

		if($result)
		{
			$return['id'] = \dash\coding::encode($result);
			\dash\log::set('AddCategory', ['code' => $result]);

			if(self::$debug) \dash\notif::ok(T_("Category successfully added"));
			return $return;
		}
		else
		{
			if(self::$debug) \dash\notif::error(T_("Can not insert new cat"));
			return false;
		}

	}

	public static function remove($_old_cat)
	{
		if(!\dash\permission::check('productCategoryListDelete'))
		{
			return false;
		}

		$json = self::list(true);

		if(!isset($json[$_old_cat]))
		{
			if(self::$debug) \dash\notif::error(T_("Category not found in your store!"), 'cat');
			return false;
		}

		unset($json[$_old_cat]);

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['cat' => $json], \lib\store::id());

		if(self::$debug) \dash\notif::warn(T_("Category successfully removed"));
		\lib\store::refresh();

		return true;

	}
	public static function remove_file($_id)
	{
		$check = self::edit([], $_id, true);
		if(!$check)
		{
			return false;
		}

		$id = \dash\coding::decode($_id);

		\lib\db\productterms::update(['file' => null], $id);
		return true;
	}


	public static function edit($_args, $_id, $_remove_file = false)
	{
		\dash\app::variable($_args);

		$id = \dash\coding::decode($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit category"), 'category');
			return false;
		}

		if(!\dash\user::id())
		{
			return false;
		}

		$get = ['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1];
		$get = \lib\db\productterms::get($get);
		if(!isset($get['id']))
		{
			\dash\notif::error(T_("This is not your category"));
			return false;
		}

		if($_remove_file)
		{
			return true;
		}

		// check args
		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}


		if(!\dash\app::isset_request('slug')) unset($args['slug']);
		if(!\dash\app::isset_request('desc')) unset($args['desc']);
		if(!\dash\app::isset_request('type')) unset($args['type']);
		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('valuetype')) unset($args['valuetype']);
		if(!\dash\app::isset_request('isdefault')) unset($args['isdefault']);


		if(!empty($args))
		{
			\lib\db\productterms::update($args, $id);
			\dash\log::set('EditCategory', ['code' => $id]);
		}

		return true;
	}




	/**
	 * Gets the product.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The product.
	 */
	public static function list($_string = null, $_args = [])
	{
		if(!\dash\user::id())
		{
			return false;
		}

		if(!\lib\store::id())
		{
			return false;
		}

		$default_args =
		[
			'order'    => null,
			'sort'     => null,

		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$option             = [];
		$option             = array_merge($default_args, $_args);

		if($option['order'])
		{
			if(!in_array($option['order'], ['asc', 'desc']))
			{
				unset($option['order']);
			}
		}

		if($option['sort'])
		{
			if(!in_array($option['sort'], self::$sort_field))
			{
				unset($option['sort']);
			}
		}

		$result = \lib\db\productterms::search($_string, $option);

		$temp             = [];

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


	/**
	 * ready data of product to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$result = [];

		if(!is_array($_data))
		{
			return null;
		}

		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'creator':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'slug':
					$result[$key] = isset($value) ? (string) $value : null;
					break;

				case 'meta':
					if(is_string($value))
					{
						$result[$key] = json_decode($value, true);
					}
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