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
		$sort_list[] = ['title' => T_("Latests"), 	'query' => ['sort' => 'datemodified',		 'order' => 'desc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date ASC"), 	'query' => ['sort' => 'datecreated',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date DESC"), 'query' => ['sort' => 'datecreated',		 'order' => 'desc'], 	'public' => false];

		if($_module !== 'website')
		{
			$sort_list[] = ['title' => T_("Conversations"), 'query' => ['sort' => 'plus',		 'order' => 'desc'], 	'public' => false];
		}


		return $sort_list;

	}



	private static function list_of_filter($_module = null)
	{

		$list = [];

		$list['awaiting']  = ['key' => 'awaiting', 	'group' => T_("Status"), 'title' => T_('Awaiting'),  'query' => ['status' => 'awaiting'], 	'public' => true];
		$list['answered']  = ['key' => 'answered', 	'group' => T_("Status"), 'title' => T_('Answered'),  'query' => ['status' => 'answered'], 	'public' => true];
		$list['close']     = ['key' => 'close', 	'group' => T_("Status"), 'title' => T_('Closed'), 	 'query' => ['status' => 'close'], 		'public' => true];

		if($_module !== 'website')
		{
			$list['spam']      = ['key' => 'spam', 		'group' => T_("Status"), 'title' => T_('Spam'), 			'query' => ['status' => 'spam'], 	'public' => true];
			$list['deleted']   = ['key' => 'deleted', 	'group' => T_("Status"), 'title' => T_('Deleted'), 			'query' => ['status' => 'deleted'], 'public' => true];
			$list['solved']    = ['key' => 'solved', 	'group' => T_("Solved"), 'title' => T_('Solved ticket'), 	'query' => ['so' => 'y'], 			'public' => true];
			$list['notsolved'] = ['key' => 'notsolved', 'group' => T_("Solved"), 'title' => T_('Un Solved ticket'), 'query' => ['so' => 'n'], 			'public' => true];
		}

		return $list;

	}

}
?>