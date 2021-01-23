<?php
namespace dash\app\ticket;

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

		$list = [];

		$list['awaiting']  = ['key' => 'awaiting', 	'group' => T_("Statis"), 'title' => T_('Awaiting'), 	'query' => ['status' => 'awaiting'], 	'public' => true];
		$list['answered']  = ['key' => 'answered', 	'group' => T_("Statis"), 'title' => T_('Answered'), 	'query' => ['status' => 'answered'], 	'public' => true];
		$list['close']     = ['key' => 'close', 	'group' => T_("Statis"), 'title' => T_('Closed'), 		'query' => ['status' => 'close'], 	'public' => true];
		$list['spam']      = ['key' => 'spam', 		'group' => T_("Statis"), 'title' => T_('Spam'), 		'query' => ['status' => 'spam'], 	'public' => true];
		$list['deleted']   = ['key' => 'deleted', 	'group' => T_("Statis"), 'title' => T_('Deleted'), 		'query' => ['status' => 'deleted'], 	'public' => true];

		$list['solved']    = ['key' => 'solved', 	'group' => T_("Solved"), 'title' => T_('Solved ticket'), 'query' => ['so' => 'y'], 	'public' => true];
		$list['notsolved'] = ['key' => 'notsolved', 'group' => T_("Solved"), 'title' => T_('Un Solved ticket'), 'query' => ['so' => 'n'], 	'public' => true];

		return $list;

	}

}
?>