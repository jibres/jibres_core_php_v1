<?php
namespace dash\app\posts;

class filter
{

	// get public sort list for api and application
	public static function public_sort_list($_module = null)
	{
		$_module = \dash\validate::string($_module);
		$list = self::sort_list($_module);
		$public_sort_list = [];
		foreach ($list as $key => $value)
		{
			if(isset($value['public']) && $value['public'])
			{
				$public_sort_list[] = $value;
			}
		}

		return $public_sort_list;
	}


	public static function check_allow($_sort, $_order, $_module = null)
	{
		$order = mb_strtolower($_order);
		if($order && in_array($order, ['asc', 'desc']))
		{
			$sort = mb_strtolower($_sort);
			if($sort)
			{
				$list     = self::sort_list($_module);
				$query    = array_column($list, 'query');
				$sort_key = array_column($query, 'sort');

				if(in_array($sort, $sort_key))
				{
					return true;
				}
			}
		}

		return false;
	}



	public static function sort_list($_module = null)
	{
		// public => true means show in api and site
		$sort_list   = [];
		// $sort_list[] = ['title' => T_("None"), 				'query' => [], 												'public' => true];
		$sort_list[] = ['title' => T_("Title ASC"), 		'query' => ['sort' => 'title',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Title DESC"), 		'query' => ['sort' => 'title',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Publish date DESC"), 'query' => ['sort' => 'publishdate', 'order' => 'desc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Publish date ASC"), 	'query' => ['sort' => 'publishdate', 'order' => 'asc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Date modified DESC"),'query' => ['sort' => 'datemodified', 'order' => 'desc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date modified ASC"), 'query' => ['sort' => 'datemodified', 'order' => 'asc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Date created DESC"),'query' => ['sort' => 'datecreated', 'order' => 'desc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date created ASC"), 'query' => ['sort' => 'datecreated', 'order' => 'asc'], 		'public' => false];


		$current_string_query = \dash\request::get();
		unset($current_string_query['sort']);
		unset($current_string_query['order']);

		foreach ($sort_list as $key => $value)
		{
			$myQuery = [];
			$myQuery = array_merge($value['query'], $current_string_query);
			$sort_list[$key]['query_string'] = http_build_query($myQuery);
		}

		return $sort_list;
	}


	public static function list()
	{
		$list = self::list_of_filter();

		$get = \dash\request::get();

		foreach ($list as $key => $value)
		{
			$active = false;
			foreach ($value['query'] as $k => $v)
			{
				if(isset($get[$k]) && $get[$k] == $v)
				{
					$active = true;
					break;
				}
			}

			if($active)
			{
				$myQuery      = array_map(function($_a) {return null;}, $value['query']);
				$query_string = \dash\request::fix_get($myQuery);
			}
			else
			{
				$query_string = \dash\request::fix_get($value['query']);
			}

			$list[$key]['query_string'] = $query_string;
			$list[$key]['is_active']    = $active;
		}

		return $list;
	}


	private static function list_of_filter()
	{

		$list = [];

		$list['published'] =
		[
			'key'            => 'published',
			'group'          => T_("Status"),
			'title'          => T_("Published"),
			'query'			 => ['status' => 'publish'],
			'public'         => false,
		];

		$list['draft'] =
		[
			'key'            => 'draft',
			'group'          => T_("Status"),
			'title'          => T_("Draft"),
			'query'			 => ['status' => 'draft'],
			'public'         => false,
		];


		$list['trash'] =
		[
			'key'            => 'trash',
			'group'          => T_("Status"),
			'title'          => T_("Trash"),
			'query'			 => ['status' => 'deleted'],
			'public'         => false,
		];

		$list['publishdate'] =
		[
			'key'            => 'publishdate',
			'group'          => T_("Status"),
			'title'          => T_("Publish in the future"),
			'query'			 => ['pd' => 1],
			'public'         => false,
		];


		$list['have_gallery'] =
		[
			'key'            => 'have_gallery',
			'group'          => T_("Gallery"),
			'title'          => T_("Have gallery"),
			'query'			 => ['g' => 'y'],
			'public'         => false,
		];


		$list['have_not_gallery'] =
		[
			'key'            => 'have_not_gallery',
			'group'          => T_("Gallery"),
			'title'          => T_("Have not gallery"),
			'query'			 => ['g' => 'n'],
			'public'         => false,
		];


		$list['with_thumb'] =
		[
			'key'            => 'with_thumb',
			'group'          => T_("SEO"),
			'title'          => T_("With featured image"),
			'query'			 => ['fi' => 'y'],
			'public'         => false,
		];


		$list['whitout_thumb'] =
		[
			'key'            => 'whitout_thumb',
			'group'          => T_("SEO"),
			'title'          => T_("Without featured image"),
			'query'			 => ['fi' => 'n'],
			'public'         => false,
		];


		$list['with_cover'] =
		[
			'key'            => 'with_cover',
			'group'          => T_("SEO"),
			'title'          => T_("With cover"),
			'query'			 => ['co' => 'y'],
			'public'         => false,
		];


		$list['whitout_cover'] =
		[
			'key'            => 'whitout_cover',
			'group'          => T_("SEO"),
			'title'          => T_("Without cover"),
			'query'			 => ['co' => 'n'],
			'public'         => false,
		];

		$list['special_seo'] =
		[
			'key'            => 'special_seo',
			'group'          => T_("SEO"),
			'title'          => T_("Special SEO"),
			'query'			 => ['seo' => 'full'],
			'public'         => false,
		];


		$list['url_none'] =
		[
			'key'            => 'url_none',
			'group'          => T_("URL"),
			'title'          => T_("Without special address"),
			'query'			 => ['sa' => 'n'],
			'public'         => false,
		];


		$list['url_special'] =
		[
			'key'            => 'url_special',
			'group'          => T_("URL"),
			'title'          => T_("With special address"),
			'query'			 => ['sa' => 'y'],
			'public'         => false,
		];


		$list['url_under_tag'] =
		[
			'key'            => 'url_under_tag',
			'group'          => T_("URL"),
			'title'          => T_("Under tag"),
			'query'			 => ['sa' => 'yt'],
			'public'         => false,
		];


		$list['url_under_page'] =
		[
			'key'            => 'url_under_page',
			'group'          => T_("URL"),
			'title'          => T_("Under page"),
			'query'			 => ['sa' => 'yp'],
			'public'         => false,
		];


		$list['comment_allow'] =
		[
			'key'            => 'comment_allow',
			'group'          => T_("Comments"),
			'title'          => T_("Allow comments"),
			'query'			 => ['com' => 'y'],
			'public'         => false,
		];


		$list['comment_disallow'] =
		[
			'key'            => 'comment_disallow',
			'group'          => T_("Comments"),
			'title'          => T_("Comments not allowed"),
			'query'			 => ['com' => 'n'],
			'public'         => false,
		];


		$list['have_tag'] =
		[
			'key'            => 'have_tag',
			'group'          => T_("Tag"),
			'title'          => T_("Have tag"),
			'query'			 => ['t' => 'y'],
			'public'         => false,
		];


		$list['have_not_tag'] =
		[
			'key'            => 'have_not_tag',
			'group'          => T_("Tag"),
			'title'          => T_("Have not tag"),
			'query'			 => ['t' => 'n'],
			'public'         => false,
		];


		$list['redirecturl'] =
		[
			'key'            => 'redirecturl',
			'group'          => T_("Redirect"),
			'title'          => T_("Have Redirect url"),
			'query'			 => ['r' => 1],
			'public'         => false,
		];


		return $list;

	}

}
?>