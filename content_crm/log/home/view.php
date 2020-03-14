<?php
namespace content_crm\log\home;


class view
{
	public static function config()
	{
		$myTitle = T_("Log");
		$myDesc  = T_('Check list of log and search or filter in them to find your logs.');


		\dash\data::page_title($myTitle);
		\dash\data::page_desc($myDesc);

		\dash\data::action_link(\dash\url::this(). '/caller');
		\dash\data::action_text(T_("Show log caller"));

		\dash\data::page_pictogram('pinboard');

		self::search_log();

	}

	public static function search_log($_args = [])
	{

		$search_string = \dash\request::get('q');
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

		if(\dash\request::get('caller'))
		{
			$args['logs.caller'] = $_GET['caller'];
		}

		if(\dash\request::get('from'))
		{
			$args['logs.from'] = \dash\request::get('from');
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


		$dataTable = \dash\app\log::list(\dash\request::get('q'), $args);

		\dash\data::dataTable($dataTable);

		$filterArray = $args;

		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArray);
		\dash\data::dataFilter($dataFilter);
	}
}
?>