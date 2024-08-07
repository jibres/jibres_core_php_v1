<?php
namespace dash\app\posts;


class get
{
	public static function post_icon($_data)
	{

		$type = 'newspaper';
		switch (a($_data, 'subtype'))
		{
		  case 'standard':
		    $type = 'newspaper';
		    break;

		  case 'gallery':
		    $type = 'images';
		    break;

		  case 'video':
		    $type = 'film';
		    break;

		  case 'audio':
		    $type = 'mic';
		    break;

		  default:
		    $type = 'newspaper';
		    break;
		}
		return \dash\utility\icon::svg($type, 'bootstrap');
	}


	public static function sitemap_list($_from, $_to)
	{
		$lang = null;
		if(!\dash\engine\store::inStore())
		{
			$lang = \dash\language::current();
		}

		$list = \dash\db\posts\get::sitemap_list($_from, $_to, $lang);

		if(!is_array($list) || !$list)
		{
			return null;
		}

		$list = array_map(['\\dash\\app\\posts\\ready', 'row'], $list);

		return $list;
	}


	public static function have_any_published_post()
	{
		$have_any_published_post = \dash\db\posts\get::have_any_published_post();
		return $have_any_published_post ? true : false;
	}

	public static function have_any_pagebuilder()
	{
		$have_any_pagebuilder = \dash\db\posts\get::have_any_pagebuilder();
		return $have_any_pagebuilder ? true : false;
	}


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

		$result = \dash\db\termusages\get::usage($post_id, $_type);

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


	public static function get_multi_post($_ids, $_options = [])
	{

		$ids = array_map(['\\dash\\coding', 'decode'], $_ids);

		$ids = array_filter($ids);
		$ids = array_unique($ids);


		if($ids)
		{
			$ids = implode(',', $ids);

			$list = \dash\db\posts\get::by_ids($ids);

			if(!is_array($list))
			{
				$list = [];
			}

			$list = array_map(['\\dash\\app\\posts\\ready', 'row'], $list);

			return $list;
		}

		return false;
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

		if(isset($detail['type']) && $detail['type'] === 'pagebuilder' && \dash\url::module() !== 'pagebuilder')
		{
			// return false;
		}

		return $detail;
	}


	public static function load_post($_id, $_force = false)
	{
		if(!$_force)
		{
			\dash\permission::access('cmsManagePost');
		}

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

		if(isset($load['type']) && $load['type'] === 'pagebuilder' && \dash\url::module() !== 'pagebuilder')
		{
			// return false;
		}


		$load = \dash\app\posts\ready::row($load);

		$tag = self::get_post_tag($id);
		$load['tags'] = $tag;


		return $load;
	}


	public static function get_post_tag($_id)
	{
		$load_tag = \dash\db\termusages\get::usage($_id, 'tag');
		if(!is_array($load_tag))
		{
			$load_tag = [];
		}

		$load_tag = array_map(['\\dash\\app\\terms\\ready', 'row'], $load_tag);

		return $load_tag;
	}


}
?>