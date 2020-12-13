<?php
namespace dash\app\posts;


class get
{

	public static function load_all_parent($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			return false;
		}

		$list = \dash\db\posts\get::list_all_of_pages($id);
		if(!is_array($list))
		{
			$list = [];
		}

		$list = array_map(['\\dash\\app\\posts\\ready', 'row'], $list);

		return $list;
	}


	public static function post_writer_list()
	{
		$list = \dash\app\posts\check::get_user_can_write_post('post');

		if(!is_array($list))
		{
			$list = [];
		}

		return $list;
	}

	public static function get_category_tag($_post_id, $_type)
	{
		$_post_id = \dash\validate::code($_post_id);
		$post_id = \dash\coding::decode($_post_id);
		if(!$post_id)
		{
			return false;
		}

		$result = \dash\db\termusages::usage($post_id, $_type);

		$temp = [];
		if(is_array($result))
		{
			foreach ($result as $key => $value)
			{
				$temp[] = \dash\app\posts\ready::row($value);
			}
		}

		return $temp;
	}

	/**
	 * Gets the user.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The user.
	 */
	public static function get($_id, $_options = [])
	{
		$default_options =
		[
			'debug'       => true,
			'check_login' => true,
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

		if($_options['check_login'])
		{
			if(!\dash\user::id())
			{
				return false;
			}
		}

		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid posts id"));
			return false;
		}

		$detail = \dash\db\posts\get::by_id($id);

		$temp = [];

		if(is_array($detail))
		{
			$temp = \dash\app\posts\ready::row($detail);
		}

		return $temp;
	}


	public static function inline_get($_id)
	{

		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid posts id"));
			return false;
		}

		$detail = \dash\db\posts\get::by_id($id);

		if(!is_array($detail))
		{
			$detail = [];
		}

		return $detail;
	}


	public static function load_post($_id)
	{
		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);

		if(!$id || !is_numeric($id))
		{
			return false;
		}

		$load = \dash\db\posts\get::by_id($id);

		if(!$load || !isset($load['user_id']) || !isset($load['type']))
		{
			return false;
		}

		$load = \dash\app\posts\ready::row($load);

		$tag = self::get_post_tag($id);
		$load['tags'] = $tag;

		$category = self::get_post_category($id);
		$load['category'] = $category;

		// var_dump($load);exit();
		return $load;
	}


	private static function get_post_category($_id)
	{
		$load_category = \dash\db\termusages\get::usage($_id, 'cat');
		if(!is_array($load_category))
		{
			$load_category = [];
		}

		$load_category = array_map(['\\dash\\app\\term', 'ready'], $load_category);

		return $load_category;
	}

	private static function get_post_tag($_id)
	{
		$load_tag = \dash\db\termusages\get::usage($_id, 'tag');
		if(!is_array($load_tag))
		{
			$load_tag = [];
		}

		$load_tag = array_map(['\\dash\\app\\term', 'ready'], $load_tag);

		return $load_tag;
	}


	public static function get_post_list($_options = [])
	{
		$default_options =
		[
			'limit'      => 10,
			'cat'        => null,
			'tag'        => null,
			'term'       => null,
			'pagenation' => false,
			'special'    => false,
			'mode'       => null,
			'post_id'    => null,
			'subtype'    => null,
		];


		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);


		if($_options['subtype'])
		{
			$_options['where']['subtype'] = $_options['subtype'];
		}

		$get_last_posts = [];

		if($_options['mode'] === 'similar')
		{
			if(isset($_options['post_id']))
			{
				$get_last_posts = \dash\db\posts::get_post_similar(\dash\coding::decode($_options['post_id']), \dash\language::current());
			}
		}
		elseif($_options['cat'])
		{
			$get_last_posts = \dash\db\posts::get_posts_term($_options, 'cat');
		}
		elseif($_options['tag'])
		{
			$get_last_posts = \dash\db\posts::get_posts_term($_options, 'tag');
		}
		elseif($_options['term'])
		{
			$_options['term'] = \dash\coding::decode($_options['term']);
			$get_last_posts   = \dash\db\posts::get_posts_term($_options, 'term');
		}
		elseif($_options['special'] !== false)
		{
			$_options['where']['special'] = $_options['special'];
			$get_last_posts = \dash\db\posts::get_special_post($_options);
		}
		else
		{
			$get_last_posts = \dash\db\posts::get_last_posts($_options);
		}

		$temp = [];
		if(is_array($get_last_posts))
		{
			foreach ($get_last_posts as $key => $value)
			{
				$temp[] = \dash\app\posts\ready::row($value);
			}
		}
		return $temp;
	}
}
?>