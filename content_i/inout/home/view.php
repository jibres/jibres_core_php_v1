<?php
namespace content_i\inout\home;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_("Bank account list"));


		\dash\data::page_pictogram('list');

		\dash\data::badge_link(\dash\url::this(). '/add');
		\dash\data::badge_text(T_('Add new accoutn'));

		$search_string            = \dash\request::get('q');
		if($search_string)
		{
			\dash\data::page_title(\dash\data::page_title(). ' | '. T_('Search for :search', ['search' => $search_string]));
		}

		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];

		$filterArgs = [];

		if(!$args['order'])
		{
			$args['order'] = 'ASC';
		}


		if(!$args['sort'])
		{
			$args['sort'] = 'sort';
		}

		if(\dash\request::get('status'))
		{
			$args['inout.status'] = \dash\request::get('status');
		}

		if(\dash\request::get('title'))
		{
			$args['inout.title'] = \dash\request::get('title');
		}

		if(\dash\request::get('subtitle'))
		{
			$args['inout.subtitle'] = \dash\request::get('subtitle');
		}

		if(\dash\request::get('cat'))
		{
			$args['inout.cat'] = \dash\request::get('cat');
		}

		if(\dash\request::get('cat2'))
		{
			$args['inout.cat2'] = \dash\request::get('cat2');
		}

		if(\dash\request::get('user'))
		{
			$args['inout.user_id'] = \dash\request::get('user');
		}

		if(\dash\request::get('size'))
		{
			$args['inout.size'] = \dash\request::get('size');
		}

		if(\dash\request::get('date'))
		{
			$mydate = date("Y-m-d", strtotime(\dash\request::get('date')));
			$args['1.1'] = [' = 1.1  AND', "date(inout.datetime) = date('$mydate') "];
		}


		$sortLink  = \dash\app\sort::make_sortLink(\lib\app\inout::$sort_field, \dash\url::this());
		$dataTable = \lib\app\inout::list(\dash\request::get('q'), $args);

		\dash\data::sortLink($sortLink);
		\dash\data::dataTable($dataTable);



		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArgs);
		\dash\data::dataFilter($dataFilter);



	}
}
?>