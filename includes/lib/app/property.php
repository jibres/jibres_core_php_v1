<?php
namespace lib\app;


class property
{


	public static $sort_field =
	[
		'title',
		'type',
		'slug',
		'url',
		'count',
		'valuetype',
	];


	public static function autoList()
	{
		$cat = \lib\db\productproperties::get_auto_list(\lib\store::id(), 'cat');
		$key = \lib\db\productproperties::get_auto_list(\lib\store::id(), 'key');
		$result = [];
		$result['cat'] = array_values($cat);
		$result['key'] = array_values($key);

		return $result;
	}

	public static function product($_id)
	{
		$id = \dash\coding::decode($_id);

		if($id)
		{
			$args =
			[
				'store_id'   => \lib\store::id(),
				'product_id' => $id,
			];

			$result = \lib\db\productproperties::get($args, ['order' => 'ORDER BY productproperties.cat, productproperties.key']);

			if(is_array($result))
			{
				$result = array_map(["self", "ready"], $result);
			}
			return $result;
		}
	}

	private static function check()
	{
		$cat = \dash\app::request('cat');
		if(!$cat)
		{
			\dash\notif::error(T_("Please fill the category"), 'cat');
			return false;
		}

		if(mb_strlen($cat) > 100)
		{
			\dash\notif::error(T_("Please set the cat less than 100 character"), 'cat');
			return false;
		}

		$key = \dash\app::request('key');
		if(!$key)
		{
			\dash\notif::error(T_("Please fill the key"), 'key');
			return false;
		}

		if(mb_strlen($key) > 200)
		{
			\dash\notif::error(T_("Please set the key less than 200 character"), 'key');
			return false;
		}

		$value = \dash\app::request('value');
		if(!$value && $value !== '0')
		{
			\dash\notif::error(T_("Please fill the value"), 'value');
			return false;
		}

		if(mb_strlen($value) > 1000)
		{
			\dash\notif::error(T_("Please set the value less than 1000 character"), 'value');
			return false;
		}

		$desc = \dash\app::request('desc');

		$product_id = \dash\app::request('product_id');
		$load = \lib\app\product::get($product_id);
		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Please set the product id"));
			return false;
		}

		$args               = [];
		$args['cat']        = $cat;
		$args['product_id'] = \dash\coding::decode($load['id']);
		$args['key']        = $key;
		$args['value']      = $value;
		$args['desc']       = $desc;

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

		$result = \lib\db\productproperties::get(['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1]);

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
		if(!\dash\permission::check('productPeropertyListAdd'))
		{
			return false;
		}

		\dash\app::variable($_args);

		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args['store_id'] = \lib\store::id();

		$check =
		[
			'cat'        => $args['cat'],
			'key'        => $args['key'],
			'store_id'   => $args['store_id'],
			'product_id' => $args['product_id'],
			'limit'      => 1,
		];

		$check_duplicate = \lib\db\productproperties::get($check);

		if(isset($check_duplicate['id']))
		{
			\dash\notif::error(T_("Duplicate property founded"), ['element' => ['cat', 'key']]);
			return false;
		}

		$result = \lib\db\productproperties::insert($args);

		if($result)
		{
			$return['id']     = \dash\coding::encode($result);
			$return['id_raw'] = $result;


			\dash\log::set('AddProductPeroperty', ['code' => $result]);

			return $return;
		}
		else
		{
			\dash\notif::error(T_("Can not insert new cat"));
			return false;
		}

	}


	public static function remove($_id)
	{
		if(!\dash\permission::check('productPeropertyListDelete'))
		{
			return false;
		}

		$load = self::get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid property"));
			return false;
		}

		\lib\db\productproperties::delete(\dash\coding::decode($_id));

		return true;
	}


	public static function edit($_args, $_id)
	{
		\dash\app::variable($_args);

		$id = \dash\coding::decode($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit property"), 'property');
			return false;
		}

		if(!\dash\user::id())
		{
			return false;
		}

		$get = ['id' => $id, 'store_id' => \lib\store::id(), 'limit' => 1];
		$get = \lib\db\productproperties::get($get);
		if(!isset($get['id']))
		{
			\dash\notif::error(T_("This is not your property"));
			return false;
		}


		// check args
		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}


		if(!empty($args))
		{
			\lib\db\productproperties::update($args, $id);
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

		$option['store_id'] = \lib\store::id();

		$result = \lib\db\productproperties::search($_string, $option);

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

				case 'valuetype':
					$result[$key] = $value;
					$result['t_'. $key] = T_(ucfirst($value));
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