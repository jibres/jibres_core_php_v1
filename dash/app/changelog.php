<?php
namespace dash\app;

/**
 * Class for changelog.
 */
class changelog
{

	public static function get($_id)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid changelog id"));
			return false;
		}

		$result = \dash\db\changelog::get_by_id($id);

		if(!$result)
		{
			\dash\notif::error(T_("Changelog not found"));
			return false;
		}

		$temp = [];
		if(is_array($result) && $result)
		{
			$temp = self::ready($result);
		}
		return $temp;
	}


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function check($_args, $_id = null)
	{
		$condition =
		[
			'title'  => 'real_html',
			'date'   => 'date',
			'link'   => 'url',
			'tag'    => 'tag',
			'sendtg' => 'bit',

		];

		$require = ['date', 'title'];
		$meta    = [];

		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);

		$data['tag1'] = null;
		$data['tag2'] = null;
		$data['tag3'] = null;
		$data['tag4'] = null;
		$data['tag5'] = null;

		if($data['tag'])
		{
			for ($i=1; $i <= 5 ; $i++)
			{
				if(isset($data['tag'][$i]))
				{
					$data['tag'. $i] = $data['tag'][$i];
				}
			}
		}

		unset($data['tag']);
		unset($data['sendtg']);


		return $data;

	}


	/**
	 * ready data of user to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$result = [];

		foreach ($_data as $key => $value)
		{

			switch ($key)
			{


				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	/**
	 * add new user
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function add($_args)
	{

		// check args
		$args = self::check($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$return              = [];
		$args['user_id']     = \dash\user::id();
		$args['datecreated'] = date("Y-m-d H:i:s");

		$changelog = \dash\db\changelog::insert($args);

		if(!$changelog)
		{
			\dash\log::set('noWayToAddChangelog');
			\dash\notif::error(T_("No way to insert changelog"));
			return false;
		}

		return $changelog;
	}


	private static $is_filtered    = false;


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args)
	{

		$condition =
		[
			'order'      => 'order',
			'sort'       => 'string_50',


		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and           = [];
		$meta          = [];
		$meta['join']  = [];
		$or            = [];
		$order_sort    = null;
		$meta['limit'] = 15;



		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " changelog.title LIKE '%$query_string%' ";

			self::$is_filtered = true;
		}



		$order_sort = " ORDER BY changelog.date DESC ";


		if(!$order_sort)
		{
			$order_sort = " ORDER BY changelog.id DESC ";
		}

		$list = \dash\db\changelog::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['self', 'ready'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;


	}




	public static function edit($_args, $_id)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit changelog"), 'changelog');
			return false;
		}

		if(!\dash\user::id())
		{
			return false;
		}

		// check args
		$args = self::check($_args, $id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(!empty($args))
		{
			\dash\db\changelog::update($args, $id);
		}

		return true;
	}


	public static function remove($_id)
	{
		$id = \dash\validate::id($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to remove this changelog"));
			return false;
		}

		if(!\dash\user::id())
		{
			return false;
		}

		\dash\db\changelog::delete($id);

		\dash\notif::ok(T_("Changelog removed"));
		return true;
	}

}
?>