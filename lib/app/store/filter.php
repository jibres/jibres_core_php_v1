<?php
namespace lib\app\store;

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

		$sort_list[] = ['title' => T_("ID, ASC"), 	'query' => ['sort' => 'id',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("ID, DESC"), 'query' => ['sort' => 'id',		 'order' => 'desc'], 	'public' => false];

		return $sort_list;
	}


	private static function list_of_filter()
	{

		$list             = [];

		$list['enable']   = ['key' => 'enable', 	'group' => T_("Status"), 'title' => T_('Enable'), 	'query' => ['status' => 'enable'], 	'public' => true];
		$list['deleted']  = ['key' => 'deleted', 	'group' => T_("Status"), 'title' => T_('Deleted'), 	'query' => ['status' => 'deleted'], 	'public' => true];
		$list['transfer'] = ['key' => 'transfer', 	'group' => T_("Status"), 'title' => T_('Transfer'), 	'query' => ['status' => 'transfer'], 	'public' => true];

		$list['dblsub']   = ['key' => 'dblsub', 	'group' => T_("Subdomain"), 'title' => T_('Duplicate subdomain'), 	'query' => ['dblsub' => 'y'], 	'public' => true];

		return $list;

	}

}
?>