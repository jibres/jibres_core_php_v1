<?php
namespace lib\app\sms\log;

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

		$list['pending'] = ['key' => 'pending', 'group' => T_("Status"), 'title' => T_('Pending'), 	'query' => ['status' => 'pending'], 'public' => true];
		$list['sending'] = ['key' => 'sending', 'group' => T_("Status"), 'title' => T_('Sending'), 	'query' => ['status' => 'sending'], 'public' => true];
		$list['send']    = ['key' => 'send', 	'group' => T_("Status"), 'title' => T_('Send'), 	'query' => ['status' => 'send'], 	'public' => true];
		$list['failed']  = ['key' => 'failed', 	'group' => T_("Status"), 'title' => T_('Failed'), 	'query' => ['status' => 'failed'], 	'public' => true];
		$list['other']   = ['key' => 'other', 	'group' => T_("Status"), 'title' => T_('Other'), 	'query' => ['status' => 'other'], 	'public' => true];

		return $list;

	}

}
?>