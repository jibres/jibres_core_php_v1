<?php
namespace dash\app;

/**
 * Class for changelog.
 */
class changelog
{

	private static function send_tg($_args, $_data)
	{
		if(!a($_args, 'sendtg'))
		{
			return;
		}

		$msg = '';
		$msg .= '☕️ '. '#ChangeLog'. "\n";
		$msg .= '<b>'. a($_data, 'title'). '</b> ';

		if(a($_data, 'link'))
		{
			$msg .= '<a href="'. a($_data, 'link'). '">'. T_("Read more"). '</a> ';
		}

		if(a($_data, 'tag1')) { $msg .= '#'. str_replace(' ', '_', $_data['tag1']). " "; }
		if(a($_data, 'tag2')) { $msg .= '#'. str_replace(' ', '_', $_data['tag2']). " "; }
		if(a($_data, 'tag3')) { $msg .= '#'. str_replace(' ', '_', $_data['tag3']). " "; }
		if(a($_data, 'tag4')) { $msg .= '#'. str_replace(' ', '_', $_data['tag4']). " "; }
		if(a($_data, 'tag5')) { $msg .= '#'. str_replace(' ', '_', $_data['tag5']). " "; }

		$msg .= "\n🕰 ". \dash\datetime::fit(date("Y-m-d H:i:s", strtotime(a($_data, 'date'))), true);

		$myData   = ['chat_id' => '-1001439876201', 'text' => $msg];
		$myResult = \dash\social\telegram\tg::json_sendMessage($myData);



	}


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

		self::send_tg($_args, $args);

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
		$param         = [];
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
			$and[] = " changelog.language = :lang ";
			$param[':lang'] = $data['language'];
		}

		if($data['tag'])
		{
			$and[] =
			"
				(changelog.tag1 = :tag1 OR
				changelog.tag2  = :tag2 OR
				changelog.tag3  = :tag3 OR
				changelog.tag4  = :tag4 OR
				changelog.tag5  = :tag5)
			";

			$param[':tag1'] = $data['tag'];
			$param[':tag2'] = $data['tag'];
			$param[':tag3'] = $data['tag'];
			$param[':tag4'] = $data['tag'];
			$param[':tag5'] = $data['tag'];

			self::$is_filtered = true;
		}

		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " changelog.title LIKE :stitle ";
			$or[] = " changelog.tag1 LIKE :stag1 ";
			$or[] = " changelog.tag2 LIKE :stag2 ";
			$or[] = " changelog.tag3 LIKE :stag3 ";
			$or[] = " changelog.tag4 LIKE :stag4 ";
			$or[] = " changelog.tag5 LIKE :stag5 ";

			$param[':stitle'] = '%'. $data['query_string']. '%';
			$param[':stag1']  = '%'. $data['query_string']. '%';
			$param[':stag2']  = '%'. $data['query_string']. '%';
			$param[':stag3']  = '%'. $data['query_string']. '%';
			$param[':stag4']  = '%'. $data['query_string']. '%';
			$param[':stag5']  = '%'. $data['query_string']. '%';

			self::$is_filtered = true;
		}

		$order_sort = " ORDER BY changelog.date IS NULL DESC, changelog.date DESC, changelog.id DESC ";


		$list = \dash\db\changelog::list($param, $and, $or, $order_sort, $meta);

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

			self::send_tg($_args, $args);
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