<?php
namespace content_i\checkbook\home;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_("checkbook list"));


		\dash\data::page_pictogram('list');

		\dash\data::badge_link(\dash\url::this(). '/add');
		\dash\data::badge_text(T_('Add new checkbook'));

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
			$args['checkbook.status'] = \dash\request::get('status');
		}

		if(\dash\request::get('bank'))
		{
			$bank = \dash\request::get('bank');
			$bank = \dash\coding::decode($bank);
			if($bank)
			{
				$args['i_checkbook.bank_id'] = $bank;
			}
		}


		if(\dash\request::get('title'))
		{
			$args['i_checkbook.title'] = \dash\request::get('title');
			$filterArgs['title']   = \dash\request::get('title');
		}

		if(\dash\request::get('firstserial'))
		{
			$args['i_checkbook.firstserial'] = \dash\request::get('firstserial');
			$filterArgs['firstserial']   = \dash\request::get('firstserial');
		}
		if(\dash\request::get('number'))
		{
			$args['i_checkbook.number'] = \dash\request::get('number');
			$filterArgs['number']   = \dash\request::get('number');
		}
		if(\dash\request::get('pagecount'))
		{
			$args['i_checkbook.pagecount'] = \dash\request::get('pagecount');
			$filterArgs['pagecount']   = \dash\request::get('pagecount');
		}


		$sortLink  = \dash\app\sort::make_sortLink(\lib\app\checkbook::$sort_field, \dash\url::this());
		$dataTable = \lib\app\checkbook::list(\dash\request::get('q'), $args);

		\dash\data::sortLink($sortLink);
		\dash\data::dataTable($dataTable);

		if(isset($args['i_checkbook.bank_id']) && isset($dataTable[0]['bank_title']))
		{
			$filterArgs['bank'] = $dataTable[0]['bank_title'];
		}



		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArgs);
		\dash\data::dataFilter($dataFilter);



	}
}
?>