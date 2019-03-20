<?php
namespace content_i\jib\home;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_("Jib list"));


		\dash\data::page_pictogram('list');

		\dash\data::badge_link(\dash\url::this(). '/add');
		\dash\data::badge_text(T_('Add jib'));

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
			$args['i_jib.status'] = \dash\request::get('status');
			$filterArgs['Status'] = \dash\request::get('status');
		}

		if(\dash\request::get('bank'))
		{
			$bank = \dash\request::get('bank');
			$bank = \dash\coding::decode($bank);
			if($bank)
			{
				$args['i_jib.bank_id'] = $bank;
			}
		}


		$sortLink  = \dash\app\sort::make_sortLink(\lib\app\jib::$sort_field, \dash\url::this());
		$dataTable = \lib\app\jib::list(\dash\request::get('q'), $args);

		\dash\data::sortLink($sortLink);
		\dash\data::dataTable($dataTable);

		if(isset($args['i_jib.bank_id']) && isset($dataTable[0]['bank_title']))
		{
			$filterArgs['bank'] = $dataTable[0]['bank_title'];
		}


		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArgs);
		\dash\data::dataFilter($dataFilter);



	}
}
?>