<?php
namespace dash\app\user;

class filter
{
	use \dash\datafilter;


	public static function sort_list_array($_module = null)
	{
		$sort_list   = [];
		$sort_list[] = ['title' => T_("Name, ASC"), 'query' => 	['sort' => 'displayname',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Name, DESC"), 'query' => ['sort' => 'displayname',		 'order' => 'desc'], 	'public' => false];
		return $sort_list;
	}


	private static function list_of_filter()
	{
		$list                  = [];
		$list['havemobile']    = ['key' => 'havemobile', 	'group' => T_("Identify"), 'title' => T_('Have Mobile'), 	'query' => ['hm' => 'y'], 	'public' => true];
		$list['havenotmobile'] = ['key' => 'havenotmobile', 	'group' => T_("Identify"), 'title' => T_('Have Not Mobile'), 	'query' => ['hm' => 'n'], 	'public' => true];
		return $list;

	}

}
?>