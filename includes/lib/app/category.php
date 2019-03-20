<?php
namespace lib\app;

/**
 * Class for category.
 */
class category
{
	public static $sort_field =
	[
		'title',
		'in',
		'type',
		'parent1',
		'status',
		'datecreated',
		'datemodified',
	];


	public static function get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			return false;
		}

		$result = \lib\db\category::get(['id' => $id, 'limit' => 1]);
		$temp = [];
		if(is_array($result))
		{
			$temp = self::ready($result);
		}
		return $temp;
	}


	public static function parent_list()
	{
		$list = self::list(null, ['parent1' => ['IS', 'NULL'], 'pagenation' => false]);
		return $list;
	}

	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function check($_id = null)
	{

		$title          = \dash\app::request('title');
		if(!$title)
		{
			\dash\notif::error(T_("Plese set title name"), 'title');
			return false;
		}

		if(mb_strlen($title) > 150)
		{
			\dash\notif::error(T_("Pleas set title name less than 150 character"), 'title');
			return false;
		}

		$in   = \dash\app::request('in') ? 1 : null;
		$type = \dash\app::request('type');

		if($type && !in_array($type, ['tag', 'cat']))
		{
			\dash\notif::error(T_("Invalid type"), 'type');
			return false;
		}

		$status        = \dash\app::request('status');
		if($status && !in_array($status, ['enable', 'disable', 'deleted']))
		{
			\dash\notif::error(T_("Invalid status"), 'status');
			return false;
		}

		$parent1 = \dash\app::request('parent');
		if($parent1)
		{
			$parent1 = \dash\coding::decode($parent1);
			if(!$parent1)
			{
				\dash\notif::error(T_("Invalid parent"), 'parent');
				return false;
			}

			$check = \lib\db\category::get(['user_id' => \dash\user::id(), 'id' => $parent1, 'limit' => 1]);
			if(!isset($check['id']))
			{
				\dash\notif::error(T_("Invalid parent"), 'parent');
				return false;
			}

			if(isset($check['parent1']) && $check['parent1'])
			{
				\dash\notif::error(T_("Can not choose this record as parent of another record"), 'parent');
				return false;
			}
		}

		$check_duplicate =
		[
			'title'   => $title,
			'parent1' => $parent1,
			'user_id' => \dash\user::id(),
			'limit'   => 1,
		];
		$check_duplicate = \lib\db\category::get($check_duplicate);

		if(isset($check_duplicate['id']))
		{
			if(intval($check_duplicate['id']) === intval($_id))
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Duplicate category title"), 'title');
				return false;
			}
		}


		$args            = [];
		$args['title']   = $title;
		$args['in']      = $in;
		$args['type']    = $type;
		$args['status']  = $status;
		$args['parent1'] = $parent1 ? $parent1 : null;

		return $args;

	}



	/**
	 * ready data of user to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$_data = \dash\app::fix_avatar($_data);
		$result = [];
		$result['location_string'] = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'parent1':
					$result[$key] = \dash\coding::encode($value);
					break;

				case 'country':
					$result[$key] = $value;
					$result['country_name'] = \dash\utility\location\countres::get_localname($value, true);
					$result['location_string'][1] = $result['country_name'];
					break;


				case 'province':
					$result[$key] = $value;
					$result['province_name'] = \dash\utility\location\provinces::get_localname($value);
					$result['location_string'][2] = $result['province_name'];
					break;

				case 'city':
					$result[$key] = $value;
					$result['city_name'] = \dash\utility\location\cites::get_localname($value);
					$result['location_string'][3] = $result['city_name'];
					break;


				default:
					$result[$key] = $value;
					break;
			}
		}
		ksort($result['location_string']);
		$result['location_string'] = array_filter($result['location_string']);
		$result['location_string'] = implode(T_(","). " ", $result['location_string']);

		return $result;
	}


	/**
	 * add new user
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args, $_option = [])
	{
		\dash\app::variable($_args);


		$default_option =
		[
			'debug'    => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$return  = [];

		if(!$args['status'])
		{
			$args['status'] = 'enable';
		}

		$args['user_id'] = \dash\user::id();

		$category = \lib\db\category::insert($args);

		if(!$category)
		{
			\dash\log::set('noWayToAddCategory');
			\dash\notif::error(T_("No way to insert category"));
			return false;
		}

		$return['cat_id'] = $category;

		\dash\log::set('iAddCategory', ['code' => $category]);
		return $return;
	}


	public static function my_list()
	{
		return self::list(null, ['parent1' => ['IS NOT', 'NULL'], 'pagenation' => false]);
	}

	public static function list($_string = null, $_args = [])
	{

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		$default_args =
		[
			'order' => null,
			'sort'  => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$option = [];
		$option = array_merge($default_args, $_args);

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

		$option['user_id'] = \dash\user::id();

		$result = \lib\db\category::search($_string, $option);

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


	public static function edit($_args, $_id)
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

		// check args
		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('in')) unset($args['in']);
		if(!\dash\app::isset_request('type')) unset($args['type']);
		if(!\dash\app::isset_request('status')) unset($args['status']);


		if(!empty($args))
		{
			\lib\db\category::update($args, $id);
			\dash\log::set('iEditCategory', ['code' => $id]);
		}

		return true;
	}
}
?>