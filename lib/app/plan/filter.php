<?php

namespace lib\app\plan;

class filter
{

	use \dash\datafilter;


	public static function sort_list_array($_module = null)
	{
		// public => true means show in api and site
		$sort_list = [];
		// $sort_list[] = ['title' => T_("None"), 				'query' => [], 												'public' => true];
		$sort_list[] =
			['title' => T_("Date ASC"), 'query' => ['sort' => 'datecreated', 'order' => 'asc'], 'public' => false];
		$sort_list[] =
			['title' => T_("Date DESC"), 'query' => ['sort' => 'datecreated', 'order' => 'desc'], 'public' => false];

		$sort_list[] = ['title' => T_("ID, ASC"), 'query' => ['sort' => 'id', 'order' => 'asc'], 'public' => false];
		$sort_list[] = ['title' => T_("ID, DESC"), 'query' => ['sort' => 'id', 'order' => 'desc'], 'public' => false];

		return $sort_list;
	}


	private static function list_of_filter()
	{

		$list = [];

		$planList = planList::list();

		foreach ($planList as $planName)
		{
			$list[$planName] =
				[
					'key'    => $planName,
					'group'  => T_("Plan"),
					'title'  => T_($planName),
					'query'  =>
						[
							'plan' => $planName,
						],
					'public' => true,
				];
		}

		$list['pmonthly'] =
			[
				'key'    => 'pmonthly',
				'group'  => T_("Period type"),
				'title'  => T_('Monthly'),
				'query'  =>
					[
						'periodtype' => 'monthly',
					],
				'public' => true,
			];

		$list['pyearly'] =
			[
				'key'    => 'pyearly',
				'group'  => T_("Period type"),
				'title'  => T_('Yearly'),
				'query'  =>
					[
						'periodtype' => 'yearly',
					],
				'public' => true,
			];

		$list['pcustom'] =
			[
				'key'    => 'pcustom',
				'group'  => T_("Period type"),
				'title'  => T_('Yearly'),
				'query'  =>
					[
						'periodtype' => 'custom',
					],
				'public' => true,
			];


		return $list;

	}

}
