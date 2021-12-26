<?php
namespace content_love\log\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Log"));

		\dash\data::action_link(\dash\url::this(). '/caller');
		\dash\data::action_text(T_("Show log caller"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		self::search_log();

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



		if(\dash\request::get('from'))
		{
			$args['from'] = \dash\request::get('from');
		}

		if(\dash\request::get('caller'))
		{
			$args['caller'] = \dash\request::get('caller');
		}

		if(\dash\request::get('to'))
		{
			$args['to'] = \dash\request::get('to');
		}

		if(\dash\request::get('code'))
		{
			$args['code'] = \dash\request::get('code');
		}


		$dataTable = \dash\app\log\search::list(\dash\validate::search_string(), $args);

		\dash\data::dataTable($dataTable);


		$filterArray = $args;

		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArray);
		\dash\data::dataFilter($dataFilter);
	}
}
?>