<?php
namespace lib\app\product;


class cat
{

	public static function fix()
	{
		$all = \dash\db::get("SELECT stores.cat, stores.id, stores.creator FROM stores WHERE stores.cat IS NOT NULL");

		if(!is_array($all) || !$all)
		{
			return;
		}

		$result = [];
		foreach ($all as $value)
		{
			$cat = json_decode($value['cat'], true);


			foreach ($cat as  $title)
			{
				if($title['title'])
				{
					\dash\engine\process::continue();
					$new_cat = self::add(['title' => $title['title']], $value['id'], $value['creator']);

					if(isset($new_cat['title']) && isset($new_cat['id_raw']))
					{
						\lib\db\products::update_where(
						[
							'cat'    => $new_cat['title'],
							'cat_id' => $new_cat['id_raw'],
						],
						[
							'store_id' => $value['id'],
							'cat'      => $title['title'],
						]);
					}
				}

			}

			\lib\db\productterms::update_count($value['id'], ['type' => 'cat']);
		}
		j('ok');


	}

	public static $debug = true;

	public static $sort_field =
	[
		'title',
		'type',
		'slug',
		'url',
		'count',
		'valuetype',

	];



	public static function check_add($_cat)
	{
		if(!$_cat && $_cat !== '0')
		{
			return;
		}

		return self::add(['title' => $_cat]);
	}


	private static function check()
	{
		$title = \dash\app::request('title');
		if(!$title && $title !== '0')
		{
			if(self::$debug) \dash\notif::error(T_("Plese fill the cat name"), 'title');
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

		if($isdefault)
		{
			\lib\db\productterms::update_where(['isdefault' => null], ['store_id' => \lib\store::id(), 'isdefault' => 1]);
		}

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


	public static function add($_args, $_store_id = null, $_creator = null)
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

		$args['creator'] =  $_creator ? $_creator : \dash\user::id();
		$args['store_id'] =  $_store_id ? $_store_id : \lib\store::id();

		$check =
		[
			'title'    => $args['title'],
			'type'     => $args['type'],
			'store_id' => $args['store_id'],
			'limit'    => 1,
		];

		$check_duplicate = \lib\db\productterms::get($check);

		if(isset($check_duplicate['id']))
		{
			if(self::$debug) \dash\notif::error(T_("Duplicate cat founded"), 'cat');

			$return =
			[
				'id'     => \dash\coding::encode($check_duplicate['id']),
				'id_raw' => $check_duplicate['id'],
				'title'  => $check_duplicate['title'],
			];

			return $return;
		}

		if(isset($args['default']) && $args['default'])
		{
			\lib\db\productterms::update_where(['default' => null], ['store_id' => \lib\store::id(), 'type' => 'cat']);
		}

		$result = \lib\db\productterms::insert($args);

		if($result)
		{
			$return['id']     = \dash\coding::encode($result);
			$return['id_raw'] = $result;
			$return['title']  = $args['title'];

			// \dash\log::set('AddCategory', ['code' => $result]);


			if(self::$debug) \dash\notif::ok(T_("Category successfully added"));

			return $return;
		}
		else
		{
			if(self::$debug) \dash\notif::error(T_("Can not insert new cat"));
			return false;
		}

	}


	public static function remove($_args, $_id)
	{
		if(!\dash\permission::check('productCategoryListDelete'))
		{
			return false;
		}

		$load = self::get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid category"));
			return false;
		}

		\dash\app::variable($_args);

		if(isset($load['count']) && $load['count'])
		{
			$whattodo = \dash\app::request('whattodo');
			if(!in_array($whattodo, ['non-cat','new-cat']))
			{
				\dash\notif::error(T_("Dont!"));
				return false;
			}

			$check = null;

			$cat = \dash\app::request('cat');
			if($cat)
			{
				$check = self::get($cat);
				if(!$cat)
				{
					\dash\notif::error(T_("Dont!"));
					return false;
				}
			}

			if($whattodo === 'new-cat' && !isset($check['id']))
			{
				\dash\notif::error(T_("Please select one category"), 'cat');
				return false;
			}

			if($whattodo === 'new-cat')
			{
				$new_cat_id = \dash\coding::decode($check['id']);
				$new_cat_title = $check['title'];

				\lib\db\products::update_where(
				[
					'cat'    => $new_cat_title,
					'cat_id' => $new_cat_id,
				],
				[
					'store_id' => \lib\store::id(),
					'cat_id'   => \dash\coding::decode($_id),
				]);

				\lib\db\productterms::update_count(\lib\store::id(), ['type' => 'cat']);

			}
			else
			{
				\lib\db\products::update_where(
				[
					'cat'    => null,
					'cat_id' => null,
				],
				[
					'store_id' => \lib\store::id(),
					'cat_id'   => \dash\coding::decode($_id),
				]);
			}
		}

		\lib\db\productterms::delete(\dash\coding::decode($_id));

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