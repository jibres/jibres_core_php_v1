<?php
namespace dash\app\transaction;

class filter
{

	use \dash\datafilter;


	public static function sort_list_array($_module = null)
	{
		$sort_list   = [];
		$sort_list[] =
			['title' => T_("Amount plus, ASC"), 'query' => ['sort' => 'plus', 'order' => 'asc'], 'public' => false];
		$sort_list[] =
			['title' => T_("Amount plus, DESC"), 'query' => ['sort' => 'plus', 'order' => 'desc'], 'public' => false];

		$sort_list[] =
			['title' => T_("Amount minus, ASC"), 'query' => ['sort' => 'minus', 'order' => 'asc'], 'public' => false];
		$sort_list[] =
			['title' => T_("Amount minus, DESC"), 'query' => ['sort' => 'minus', 'order' => 'desc'], 'public' => false];

		$sort_list[] = [
			'title'  => T_("Date register, ASC"), 'query' => ['sort' => 'datecreated', 'order' => 'asc'],
			'public' => false,
		];
		$sort_list[] = [
			'title'  => T_("Date register, DESC"), 'query' => ['sort' => 'datecreated', 'order' => 'desc'],
			'public' => false,
		];

		$sort_list[] = ['title' => T_("Date, ASC"), 'query' => ['sort' => 'date', 'order' => 'asc'], 'public' => false];
		$sort_list[] =
			['title' => T_("Date, DESC"), 'query' => ['sort' => 'date', 'order' => 'desc'], 'public' => false];

		return $sort_list;
	}


	private static function list_of_filter($_module = null, $_statistics_file = null)
	{
		$list = [];

		$list['verified']    = [
			'key'    => 'verified', 'group' => T_("Verify"), 'title' => T_('Verified'), 'query' => ['verify' => 'y'],
			'public' => true,
		];
		$list['notverified'] = [
			'key'   => 'notverified', 'group' => T_("Verify"), 'title' => T_('Not verified'),
			'query' => ['verify' => 'n'], 'public' => true,
		];


		$list['plus']  = [
			'key'   => 'plus', 'group' => T_("Type"), 'title' => T_('Increase account recharge'),
			'query' => ['ct' => 'y'], 'public' => true,
		];
		$list['minus'] = [
			'key'    => 'minus', 'group' => T_("Type"), 'title' => T_('Reduce account recharge'),
			'query'  => ['ct' => 'n'], 'public' => true,
		];


		$list['daterange'] =
			[
				'key'    => 'daterange',
				'group'  => T_("Date"),
				'title'  => T_("Show in date"),
				'mode'   => 'daterange',
				'public' => false,
			];

		if($_module !== 'member')
		{

			$list['user'] =
				[
					'key'    => 'user',
					'group'  => T_("Customer"),
					'title'  => T_("Search in customer"),
					'mode'   => 'users_search',
					'public' => false,
				];
		}

		if($_statistics_file && \dash\url::content() === 'crm')
		{
			$list['raw_file'] =
				[
					'key'       => 'raw_file',
					'mode'      => 'raw_file',
					'group'     => T_("Statistics"),
					'title'     => T_("Show statistics of this result"),
					'file_addr' => $_statistics_file,
					'public'    => false,
				];

		}

		if(\dash\engine\store::inStore())
		{
			$list['byform'] = [
				'key'   => 'byform', 'group' => T_("Form"), 'title' => T_('Transactions related to the form'),
				'query' => ['bf' => 'y'], 'public' => true,
			];

			$list['byformn'] = [
				'key'   => 'byformn', 'group' => T_("Form"), 'title' => T_('Transactions un-related to the form'),
				'query' => ['bf' => 'n'], 'public' => true,
			];

		}

		return $list;

	}

}

?>