<?php
namespace content_pardakhtyar\customer\home;


class view
{
	public static function config()
	{
		\dash\permission::access('aCustomerView');

		\dash\data::page_title(T_("customer list"));
		\dash\data::page_desc(T_('Check list of customers and search or filter in them to find your customer.'). ' '. T_('Also add or edit specefic customer.'));
		\dash\data::page_pictogram('users');

		\dash\data::badge_link(\dash\url::this(). '/add');
		\dash\data::badge_text(T_('Add new customer'));

		$search_string            = \dash\request::get('q');
		if($search_string)
		{
			\dash\data::page_title(\dash\data::page_title(). ' | '. T_('Search for :search', ['search' => $search_string]));
		}

		$filterArgs = [];

		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];

		if(!$args['order'])
		{
			$args['order'] = 'desc';
		}

		if(\dash\request::get('status'))
		{
			$args['status'] = \dash\request::get('status');
		}

		$sortLink  = \dash\app\sort::make_sortLink(\lib\pardakhtyar\app\customer::$sort_field, \dash\url::this());
		$dataTable = \lib\pardakhtyar\app\customer::list(\dash\request::get('q'), $args);

		\dash\data::sortLink($sortLink);
		\dash\data::dataTable($dataTable);

		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArgs);
		\dash\data::dataFilter($dataFilter);
	}
}
?>