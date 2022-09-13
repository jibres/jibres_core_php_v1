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
			['title' => T_("Date ASC"), 'query' => ['sort' => 'datecreated', 'order' => 'asc'], 'public' => true];
		$sort_list[] =
			['title' => T_("Date DESC"), 'query' => ['sort' => 'datecreated', 'order' => 'desc'], 'public' => true];

		$sort_list[] = ['title' => T_("ID, ASC"), 'query' => ['sort' => 'id', 'order' => 'asc'], 'public' => true];
		$sort_list[] = ['title' => T_("ID, DESC"), 'query' => ['sort' => 'id', 'order' => 'desc'], 'public' => true];

		$sort_list[] =
			['title' => T_("Price, ASC"), 'query' => ['sort' => 'finalprice', 'order' => 'asc'], 'public' => true];
		$sort_list[] =
			['title' => T_("Price, DESC"), 'query' => ['sort' => 'finalprice', 'order' => 'desc'], 'public' => true];

		$sort_list[] =
			['title' => T_("Days, DESC"), 'query' => ['sort' => 'days', 'order' => 'desc'], 'public' => true];

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
				'title'  => T_('Custom'),
				'query'  =>
					[
						'periodtype' => 'custom',
					],
				'public' => true,
			];

		$list['actionu'] =
			[
				'key'    => 'actionu',
				'group'  => T_("Action"),
				'title'  => T_('Upgrade'),
				'query'  =>
					[
						'action' => 'upgrade',
					],
				'public' => true,
			];


		$list['actiond'] =
			[
				'key'    => 'actiond',
				'group'  => T_("Action"),
				'title'  => T_('Downgrade'),
				'query'  =>
					[
						'action' => 'downgrade',
					],
				'public' => true,
			];


		$list['actione'] =
			[
				'key'    => 'actione',
				'group'  => T_("Action"),
				'title'  => T_('Extends'),
				'query'  =>
					[
						'action' => 'extends',
					],
				'public' => true,
			];

		$list['actions'] =
			[
				'key'    => 'actions',
				'group'  => T_("Action"),
				'title'  => T_('Set'),
				'query'  =>
					[
						'action' => 'set',
					],
				'public' => true,
			];

		$list['refundguarantee'] =
			[
				'key'    => 'refundguarantee',
				'group'  => T_("Refund"),
				'title'  => T_('Refund + Guarantee'),
				'query'  =>
					[
						'reason' => 'refund_guarantee',
					],
				'public' => true,
			];


		$list['refund'] =
			[
				'key'    => 'refund',
				'group'  => T_("Refund"),
				'title'  => T_('Refund'),
				'query'  =>
					[
						'reason' => 'refund',
					],
				'public' => true,
			];

		$list['setbya'] =
			[
				'key'    => 'setbya',
				'group'  => T_("Set by"),
				'title'  => T_('Admin'),
				'query'  =>
					[
						'setby' => 'admin',
					],
				'public' => true,
			];


		$list['setbyc'] =
			[
				'key'    => 'setbyc',
				'group'  => T_("Set by"),
				'title'  => T_('Customer'),
				'query'  =>
					[
						'setby' => 'customer',
					],
				'public' => true,
			];


		return $list;

	}

}
