<?php
namespace dash\app\transaction;

class filter
{
	use \dash\datafilter;


	public static function sort_list_array($_module = null)
	{
		$sort_list   = [];
		$sort_list[] = ['title' => T_("Amount plus, ASC"), 'query' => 	['sort' => 'plus',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Amount plus, DESC"), 'query' =>  ['sort' => 'plus',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Amount minus, ASC"), 'query' => 	['sort' => 'minus',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Amount minus, DESC"), 'query' => ['sort' => 'minus',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Date register, ASC"), 'query' => ['sort' => 'datecreated',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date register, DESC"), 'query' =>['sort' => 'datecreated',		 'order' => 'desc'], 	'public' => false];
		return $sort_list;
	}


	private static function list_of_filter($_module = null)
	{
		$list                      = [];

		if($_module === 'all')
		{
			$list['verified']        = ['key' => 'verified', 	'group' => T_("Verify"), 'title' => T_('Verified'), 	'query' => ['verify' => 'y'], 	'public' => true];
			$list['notverified']     = ['key' => 'notverified', 'group' => T_("Verify"), 'title' => T_('Not verified'), 	'query' => ['verify' => 'n'], 	'public' => true];
		}

		return $list;

	}

}
?>