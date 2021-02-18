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
			$list['active'] = ['key' => 'active', 'group' => T_("Status"), 'title' => T_('Last active ticket'), 'query' => ['act' => 'y'], 			'public' => true];

			$list['spam']      = ['key' => 'spam', 		'group' => T_("Status"), 'title' => T_('Spam'), 			'query' => ['status' => 'spam'], 	'public' => true];
			$list['deleted']   = ['key' => 'deleted', 	'group' => T_("Status"), 'title' => T_('Deleted'), 			'query' => ['status' => 'deleted'], 'public' => true];
			$list['solved']    = ['key' => 'solved', 	'group' => T_("Solved"), 'title' => T_('Solved ticket'), 	'query' => ['so' => 'y'], 			'public' => true];
			$list['notsolved'] = ['key' => 'notsolved', 'group' => T_("Solved"), 'title' => T_('Un Solved ticket'), 'query' => ['so' => 'n'], 			'public' => true];

			$list['havefile']    = ['key' => 'havefile', 	'group' => T_("Attachment"), 'title' => T_('With attachment'), 	'query' => ['hf' => 'y'], 			'public' => true];
			$list['havenotfile'] = ['key' => 'havenotfile', 'group' => T_("Attachment"), 'title' => T_('Without attachment'), 'query' => ['hf' => 'n'], 			'public' => true];

			$list['user']    = ['key' => 'user', 	'group' => T_("Customer"), 'title' => T_('Logined'), 	'query' => ['hu' => 'y'], 			'public' => true];
			$list['guest'] = ['key' => 'guest', 'group' => T_("Customer"), 'title' => T_('Guest user'), 'query' => ['hu' => 'n'], 			'public' => true];

			if(!\dash\engine\store::inStore())
			{
				$list['bug']    = ['key' => 'bug', 	'group' => T_("Type"), 'title' => T_('Bug'), 	'query' => ['st' => 'bug'], 			'public' => true];
				$list['contact'] = ['key' => 'contact', 'group' => T_("Type"), 'title' => T_('Contact us'), 'query' => ['st' => 'contact'], 			'public' => true];

			}
		}

		return $list;

	}

}
?>