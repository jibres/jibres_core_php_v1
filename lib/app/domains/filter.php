<?php
namespace lib\app\domains;

class filter
{
	use \dash\datafilter;


	public static function sort_list_array($_module = null)
	{
		// public => true means show in api and site
		$sort_list   = [];
		$sort_list[] = ['title' => T_("Name ASC"), 	'query' => ['sort' => 'name',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Name DESC"), 'query' => ['sort' => 'name',		 'order' => 'desc'], 	'public' => false];



		$sort_list[] = ['title' => T_("Expire date ASC"), 	'query' => ['sort' => 'dateexpire',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Expire date DESC"), 'query' => ['sort' => 'dateexpire',		 'order' => 'desc'], 	'public' => false];

		$sort_list[] = ['title' => T_("Date ASC"), 	'query' => ['sort' => 'dateregister',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date DESC"), 'query' => ['sort' => 'dateregister',		 'order' => 'desc'], 	'public' => false];


		$sort_list[] = ['title' => T_("Date ASC"), 	'query' => ['sort' => 'dateupdate',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date DESC"), 'query' => ['sort' => 'dateupdate',		 'order' => 'desc'], 	'public' => false];



		return $sort_list;
	}


	private static function list_of_filter()
	{

		$list                 = [];

		$list['autorenewon']  = ['key' => 'autorenewon', 	'group' => T_("Autorenew"), 'title' => T_('Autorenew on'), 	'query' => ['autorenew' => 'on'], 	'public' => true];
		$list['autorenewoff'] = ['key' => 'autorenewoff', 	'group' => T_("Autorenew"), 'title' => T_('Autorenew off'), 'query' => ['autorenew' => 'off'], 	'public' => true];
		$list['autorenewdefault'] = ['key' => 'autorenewoff', 	'group' => T_("Autorenew"), 'title' => T_('Autorenew default'), 'query' => ['autorenew' => 'default'], 	'public' => true];

		$list['lockon']       = ['key' => 'lockon', 		'group' => T_("Lock"), 'title' => T_('lock on'), 			'query' => ['lock' => 'on'], 	'public' => true];
		$list['lockoff']      = ['key' => 'lockoff', 		'group' => T_("Lock"), 'title' => T_('lock off'), 			'query' => ['lock' => 'off'], 	'public' => true];
		$list['lockunknown']  = ['key' => 'lockunknown',	'group' => T_("Lock"), 'title' => T_('lock unknown'), 		'query' => ['lock' => 'unknown'], 	'public' => true];

		$list['registrarir']  = ['key' => 'registrarir', 	'group' => T_("Registrar"), 'title' => T_('IRNIC'), 		'query' => ['reg' => 'ir'], 	'public' => true];
		$list['registrarcom'] = ['key' => 'registrarcom', 	'group' => T_("Registrar"), 'title' => T_('Onlinenic'), 	'query' => ['reg' => 'com'], 	'public' => true];


		return $list;

	}

}
?>