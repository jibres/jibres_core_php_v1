<?php
namespace content_i\bank\home;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_("Bank account list"));

		\dash\data::page_pictogram('list');

		\dash\data::badge_link(\dash\url::this(). '/add');
		\dash\data::badge_text(T_('Add new bank account'));

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
			$args['i_banks.status'] = \dash\request::get('status');
			$filterArgs['Status'] = T_(ucfirst(\dash\request::get('status')));
		}



		if(\dash\request::get('bank'))
		{
			$args['i_banks.bank'] = \dash\request::get('bank');
			$filterArgs['Bank'] = T_(ucfirst(\dash\request::get('bank')));
		}

		$sortLink  = \dash\app\sort::make_sortLink(\lib\app\bank::$sort_field, \dash\url::this());
		$dataTable = \lib\app\bank::list(\dash\request::get('q'), $args);

		\dash\data::sortLink($sortLink);
		\dash\data::dataTable($dataTable);


		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArgs);
		\dash\data::dataFilter($dataFilter);



	}
}
?>