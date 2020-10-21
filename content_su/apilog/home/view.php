<?php
namespace content_su\apilog\home;


class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\face::title(T_("Api Log"));

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


		$where =
		[
			'user_id',
			'token',
			'apikey',
			'appkey',
			'zoneid',
			'subdomain',
			'version',
			'urlmd5',
			'method',
			'headerlen',
			'bodylen',
			'datesend',
			'pagestatus',
			'resultstatus',
			'dateresponse',
			'notif',
			'responselen',
		];

		foreach ($where as $key => $value)
		{
			if(\dash\request::get($value))
			{
				$args[$value] = \dash\request::get($value);
			}

		}


		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}

		if(!$args['sort'])
		{
			$args['sort'] = 'id';
		}


		$dataTable = \dash\db\apilog::search(\dash\request::get('q'), $args);

		\dash\data::dataTable($dataTable);

		$filterArray = $args;

		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArray);
		\dash\data::dataFilter($dataFilter);
	}
}
?>