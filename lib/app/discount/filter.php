<?php
namespace lib\app\discount;

class filter
{
	use \dash\datafilter;

	public static function sort_list_array($_module = null)
	{
		// public => true means show in api and site


		$sort_list[] = ['title' => T_("Code ASC"), 		'query' => ['sort' => 'code',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Code DESC"), 		'query' => ['sort' => 'code',		 'order' => 'desc'], 	'public' => false];


		$sort_list[] = ['title' => T_("Date created DESC"),'query' => ['sort' => 'datecreated', 'order' => 'desc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date created ASC"), 'query' => ['sort' => 'datecreated', 'order' => 'asc'], 		'public' => false];


		return $sort_list;
	}




	private static function list_of_filter($_module = null)
	{

		$list = [];

		$list['published'] =
		[
			'key'            => 'published',
			'group'          => T_("Status"),
			'title'          => T_("Enable"),
			'query'			 => ['status' => 'enable'],
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



		return $list;

	}

}
?>