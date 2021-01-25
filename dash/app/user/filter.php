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

		$sort_list[] = ['title' => T_("Date register, ASC"), 'query' => 	['sort' => 'datecreated',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date register, DESC"), 'query' => ['sort' => 'datecreated',		 'order' => 'desc'], 	'public' => false];
		return $sort_list;
	}


	private static function list_of_filter()
	{
		$list                      = [];
		$list['havemobile']        = ['key' => 'havemobile', 	'group' => T_("Identify"), 'title' => T_('Have Mobile'), 	'query' => ['hm' => 'y'], 	'public' => true];
		$list['havenotmobile']     = ['key' => 'havenotmobile', 'group' => T_("Identify"), 'title' => T_('Have Not Mobile'), 	'query' => ['hm' => 'n'], 	'public' => true];

		$list['active']            = ['key' => 'active', 'group' => T_("Status"), 'title' => T_('Active user'), 	'query' => ['status' => 'active'], 	'public' => true];
		$list['awaiting']          = ['key' => 'awaiting', 'group' => T_("Status"), 'title' => T_('Awaiting user'), 	'query' => ['status' => 'awaiting'], 	'public' => true];
		$list['ban']               = ['key' => 'ban', 'group' => T_("Status"), 'title' => T_('Banned user'), 	'query' => ['status' => 'ban'], 	'public' => true];

		$list['havepermission']    = ['key' => 'havepermission', 'group' => T_("Permission"), 'title' => T_('Have permission'), 	'query' => ['hp' => 'y'], 	'public' => true];
		$list['havenotpermission'] = ['key' => 'havenotpermission', 'group' => T_("Permission"), 'title' => T_('Have not permission'), 	'query' => ['hp' => 'n'], 	'public' => true];

		if(\dash\engine\store::inStore())
		{
			$list['haveorder']    = ['key' => 'haveorder', 		'group' => T_("Order"), 'title' => T_('Have Order'), 	 'query' => ['ho' => 'y'], 	'public' => true];
			$list['havenotorder'] = ['key' => 'havenotorder', 	'group' => T_("Order"), 'title' => T_('Have Not Order'), 'query' => ['ho' => 'n'], 	'public' => true];

			$list['havecart']     = ['key' => 'havecart', 		'group' => T_("Order"), 'title' => T_('Have Cart'), 	'query' => ['hc' => 'y'], 	'public' => true];
			$list['havenotcart']  = ['key' => 'havenotcart', 	'group' => T_("Order"), 'title' => T_('Have Not Cart'), 'query' => ['hc' => 'n'], 	'public' => true];
		}
		return $list;

	}

}
?>