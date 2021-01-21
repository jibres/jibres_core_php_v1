<?php
namespace dash\app\posts;

class filter
{
	use \dash\datafilter;

	public static function sort_list_array($_module = null)
	{
		// public => true means show in api and site
		$sort_list   = [];
		// $sort_list[] = ['title' => T_("None"), 				'query' => [], 												'public' => true];
		$sort_list[] = ['title' => T_("Title ASC"), 		'query' => ['sort' => 'title',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Title DESC"), 		'query' => ['sort' => 'title',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Best SEO rank"),		'query' => ['sort' => 'seorank', 	'order' => 'desc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Weakest SEO rank"), 	'query' => ['sort' => 'seorank', 	'order' => 'asc'], 		'public' => false];

		$sort_list[] = ['title' => T_("Publish date DESC"), 'query' => ['sort' => 'publishdate', 'order' => 'desc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Publish date ASC"), 	'query' => ['sort' => 'publishdate', 'order' => 'asc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Date modified DESC"),'query' => ['sort' => 'datemodified', 'order' => 'desc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date modified ASC"), 'query' => ['sort' => 'datemodified', 'order' => 'asc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Date created DESC"),'query' => ['sort' => 'datecreated', 'order' => 'desc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date created ASC"), 'query' => ['sort' => 'datecreated', 'order' => 'asc'], 		'public' => false];

		return $sort_list;
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