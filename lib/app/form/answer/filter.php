<?php
namespace lib\app\form\answer;

class filter
{

	use \dash\datafilter;


	public static function sort_list_array($_module = null)
	{

		// public => true means show in api and site
		$sort_list   = [];
		$sort_list[] = ['title' => T_("Sort"), 'query' => ['sort' => null, 'order' => null], 'public' => false];
		$sort_list[] = ['title' => T_("ID ASC"), 'query' => ['sort' => 'id', 'order' => 'asc'], 'public' => false];
		$sort_list[] = ['title' => T_("ID DESC"), 'query' => ['sort' => 'id', 'order' => 'desc'], 'public' => false];

		$sort_list[] =
			['title' => T_("Date ASC"), 'query' => ['sort' => 'datecreated', 'order' => 'asc'], 'public' => false];
		$sort_list[] =
			['title' => T_("Date DESC"), 'query' => ['sort' => 'datecreated', 'order' => 'desc'], 'public' => false];

		$sort_list[] =
			['title' => T_("Amount ASC"), 'query' => ['sort' => 'amount', 'order' => 'asc'], 'public' => false];
		$sort_list[] =
			['title' => T_("Amount DESC"), 'query' => ['sort' => 'amount', 'order' => 'desc'], 'public' => false];


		return $sort_list;
	}


	private static function list_of_filter()
	{

		$list                           = [];
		$list['status']                 = [
			'key'  => 'status', 'group' => T_("Status"), 'title' => T_('Filter by status'), 'public' => true,
			'mode' => 'form_answer_status',
		];
		$list['form_answer_tag_search'] =
			[
				'key'    => 'form_answer_tag_search',
				'group'  => T_("Tag"),
				'title'  => T_("Filter by tag"),
				'mode'   => 'form_answer_tag_search',
				'public' => false,
			];

		$list['daterange'] =
			[
				'key'    => 'daterange',
				'group'  => T_("Date"),
				'title'  => T_("Filter by date"),
				'mode'   => 'daterange',
				'public' => false,
			];


		$list['payedy'] =
			[
				'key'    => 'payedy',
				'group'  => T_("Payment"),
				'title'  => T_("Successful payment"),
				'query'  => ['payed' => 'y'],
				'public' => false,
			];

		$list['payedn'] =
			[
				'key'    => 'payedn',
				'group'  => T_("Payment"),
				'title'  => T_("Unsuccessful payment"),
				'query'  => ['payed' => 'n'],
				'public' => false,
			];


		return $list;

	}

}

?>