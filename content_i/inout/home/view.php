<?php
namespace content_i\inout\home;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_("In out list"));


		\dash\data::page_pictogram('list');

		\dash\data::badge_link(\dash\url::this(). '/add');
		\dash\data::badge_text(T_('Add new transaction'));

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

		if(\dash\request::get('jib'))
		{
			$jib = \dash\request::get('jib');
			$jib = \dash\coding::decode($jib);
			if($jib)
			{
				$args['i_inout.jib_id'] = $jib;
			}
		}

		if(\dash\request::get('cat'))
		{
			$cat = \dash\request::get('cat');
			$cat = \dash\coding::decode($cat);
			if($cat)
			{
				$args['i_inout.cat_id'] = $cat;
			}
		}


		if(\dash\request::get('plus'))
		{
			$args['i_inout.plus'] = \dash\request::get('plus');
			$filterArgs['plus']   = \dash\request::get('plus');
		}
		if(\dash\request::get('minus'))
		{
			$args['i_inout.minus'] = \dash\request::get('minus');
			$filterArgs['minus']   = \dash\request::get('minus');
		}
		if(\dash\request::get('discount'))
		{
			$args['i_inout.discount'] = \dash\request::get('discount');
			$filterArgs['discount']   = \dash\request::get('discount');
		}
		if(\dash\request::get('thirdparty'))
		{
			$args['i_inout.thirdparty'] = \dash\request::get('thirdparty');
			$filterArgs['thirdparty']   = \dash\request::get('thirdparty');
		}


		$sortLink  = \dash\app\sort::make_sortLink(\lib\app\inout::$sort_field, \dash\url::this());
		$dataTable = \lib\app\inout::list(\dash\request::get('q'), $args);

		\dash\data::sortLink($sortLink);
		\dash\data::dataTable($dataTable);

		if(isset($args['i_inout.jib_id']) && isset($dataTable[0]['jib_title']))
		{
			$filterArgs['jib'] = $dataTable[0]['jib_title'];
		}

		if(isset($args['i_inout.cat_id']) && isset($dataTable[0]['cat_title']))
		{
			$filterArgs['category'] = $dataTable[0]['cat_title'];
		}


		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArgs);
		\dash\data::dataFilter($dataFilter);



	}
}
?>