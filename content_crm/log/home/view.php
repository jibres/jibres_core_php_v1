<?php
namespace content_crm\log\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Log"));

		// btn
		\dash\data::back_text(T_('CRM'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::listEngine_start(true);
		// \dash\data::listEngine_search(\dash\url::that());
		// \dash\data::listEngine_filter(true);
		// \dash\data::listEngine_sort(true);

			// back
		\dash\data::back_text(T_('CRM'));
		\dash\data::back_link(\dash\url::here());

		// btn
		// \dash\data::action_text(T_('Add New Transaction'));
		// \dash\data::action_icon('plus');
		// \dash\data::action_link(\dash\url::this(). '/add');

		\dash\data::listEngine_start(true);
		// \dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(false);

		$args =
		[
			'order'     => \dash\request::get('order'),
			'sort'      => \dash\request::get('sort'),
			'status'    => \dash\request::get('status'),
			'show_type' => 'user',
		];


		$search_string   = \dash\validate::search_string();
		$logList = \dash\app\log\search::list($search_string, $args);

		\dash\data::dataTable($logList);

		$isFiltered = \dash\app\log\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}


	}






	public static function search_log($_args = [])
	{

		$search_string = \dash\validate::search_string();
		if($search_string)
		{
			$myTitle .= ' | '. T_('Search for :search', ['search' => $search_string]);
		}

		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];

		if($_args && is_array($_args))
		{
			$args = array_merge($args, $_args);
		}

		if(!$args['sort'])
		{
			$args['sort'] = 'id';
		}

		if(!$args['order'])
		{
			$args['order'] = 'desc';
		}

		if(\dash\request::get('status'))
		{
			$args['logs.status'] = \dash\request::get('status');
		}

		if(\dash\request::get('subdomain'))
		{
			$args['logs.subdomain'] = \dash\request::get('subdomain');
		}


		if(\dash\request::get('from'))
		{
			$args['logs.from'] = \dash\request::get('from');
		}

		if(\dash\request::get('caller'))
		{
			$args['logs.caller'] = \dash\request::get('caller');
		}

		if(\dash\request::get('to'))
		{
			$args['logs.to'] = \dash\request::get('to');
		}

		if(\dash\request::get('code'))
		{
			$args['logs.code'] = \dash\request::get('code');
		}

		if(\dash\request::get('data'))
		{
			$args['logs.ata'] = \dash\request::get('data');
		}

		if(\dash\request::get('datecreated'))
		{
			$args['logs.datecreated'] = \dash\request::get('datecreated');
		}

		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}

		if(!$args['sort'])
		{
			$args['sort'] = 'id';
		}


		$dataTable = \dash\app\log::list(\dash\validate::search_string(), $args);

		\dash\data::dataTable($dataTable);

		$filterArray = $args;

		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArray);
		\dash\data::dataFilter($dataFilter);
	}
}
?>