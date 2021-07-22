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


	public static function list_changelog_tags()
	{
		$list = \dash\db\changelog::list_changelog_tags();
		$tag = [];
		foreach ($list as $key => $value)
		{
			$tag[] = a($value, 'tag1');
			$tag[] = a($value, 'tag2');
			$tag[] = a($value, 'tag3');
			$tag[] = a($value, 'tag4');
			$tag[] = a($value, 'tag5');
		}

		$tag = array_filter($tag);
		$tag = array_unique($tag);

		return $tag;
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
			'title'  => 'desc',
			'date'   => 'date',
			'link'   => 'url',
			'tag'    => 'tag',
			'sendtg' => 'bit',

		];

		$require = ['title'];
		$meta    = [];

		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);

		$data['tag1'] = null;
		$data['tag2'] = null;
		$data['tag3'] = null;
		$data['tag4'] = null;
		$data['tag5'] = null;

		if($data['tag'])
		{
			for ($i=0; $i <= 4 ; $i++)
			{
				if(isset($data['tag'][$i]))
				{
					$data['tag'. $i + 1] = $data['tag'][$i];
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
		$args['language'] = \dash\language::current();

		$changelog = \dash\db\changelog::insert($args);

		if(!$changelog)
		{
			\dash\log::set('noWayToAddChangelog');
			\dash\notif::error(T_("No way to insert changelog"));
			return false;
		}

		\dash\notif::ok(T_("Changelog added"));

		return $changelog;
	}


	private static $is_filtered    = false;


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function public_list($_tag = null)
	{
		return self::list(null, ['language' => \dash\language::current(), 'limit' => 1000, 'tag' => $_tag]);
	}


	public static function list($_query_string, $_args)
	{

		$condition =
		[
			'order'    => 'order',
			'sort'     => 'string_50',
			'tag'      => 'string_50',
			'language' => 'language',
			'limit'    => 'int',
		];

		$require = [];
		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and           = [];
		$meta          = [];
		$meta['join']  = [];
		$or            = [];
		$order_sort    = null;
		$meta['limit'] = 100;

		if($data['limit'])
		{
			$meta['limit'] = $data['limit'];
		}

		if($data['language'])
		{
			$and[] = " changelog.language = '$data[language]' ";
		}

		if($data['tag'])
		{
			$and[] =
			"
				(changelog.tag1 = '$data[tag]' OR
				changelog.tag2  = '$data[tag]' OR
				changelog.tag3  = '$data[tag]' OR
				changelog.tag4  = '$data[tag]' OR
				changelog.tag5  = '$data[tag]')
			";

			self::$is_filtered = true;
		}

		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " changelog.title LIKE '%$query_string%' ";
			$or[] = " changelog.tag1 LIKE '%$query_string%' ";
			$or[] = " changelog.tag2 LIKE '%$query_string%' ";
			$or[] = " changelog.tag3 LIKE '%$query_string%' ";
			$or[] = " changelog.tag4 LIKE '%$query_string%' ";
			$or[] = " changelog.tag5 LIKE '%$query_string%' ";

			self::$is_filtered = true;
		}

		$order_sort = " ORDER BY changelog.date IS NULL DESC, changelog.date DESC, changelog.id ASC ";


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

		$exception = [];
		if(isset($_args['tag']))
		{
			$exception[] = 'tag1';
			$exception[] = 'tag2';
			$exception[] = 'tag3';
			$exception[] = 'tag4';
			$exception[] = 'tag5';
		}

		$args = \dash\cleanse::patch_mode($_args, $args, $exception);

		if(!empty($args))
		{
			$args['datemodified'] = date("Y-m-d H:i:s");

			\dash\db\changelog::update($args, $id);
		}

		\dash\notif::ok(T_("Saved"));

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