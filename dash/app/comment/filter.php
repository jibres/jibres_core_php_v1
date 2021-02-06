<?php
namespace dash\app\comment;

class filter
{
	use \dash\datafilter;


	public static function sort_list_array($_module = null)
	{
		// public => true means show in api and site
		$sort_list   = [];
		// $sort_list[] = ['title' => T_("None"), 				'query' => [], 												'public' => true];
		$sort_list[] = ['title' => T_("Date ASC"), 	'query' => ['sort' => 'datecreated',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date DESC"), 'query' => ['sort' => 'datecreated',		 'order' => 'desc'], 	'public' => false];

		return $sort_list;
	}


	private static function list_of_filter()
	{

		$list               = [];

		$list['approved']   = ['key' => 'approved', 	'group' => T_("Status"), 'title' => T_('Approved'), 	'query' => ['status' => 'approved'], 	'public' => true];
		$list['unapproved'] = ['key' => 'unapproved', 	'group' => T_("Status"), 'title' => T_('Unapproved'), 	'query' => ['status' => 'unapproved'], 	'public' => true];
		$list['awaiting']   = ['key' => 'awaiting', 	'group' => T_("Status"), 'title' => T_('Awaiting'), 	'query' => ['status' => 'awaiting'], 	'public' => true];
		$list['spam']       = ['key' => 'spam', 		'group' => T_("Status"), 'title' => T_('Spam'), 	'query' => ['status' => 'spam'], 	'public' => true];
		$list['posts']      = ['key' => 'posts', 		'group' => T_("Posts"),  'title' => T_('Comment of special posts'),	'public' => true, 'mode' => 'posts_search'];

		return $list;

	}

}
?>