<?php
namespace content_i\category\home;


class view
{
	public static function config()
	{

		\dash\data::page_title(T_("Categroy list"));

		\dash\data::page_pictogram('list');

		\dash\data::badge_link(\dash\url::this(). '/add');
		\dash\data::badge_text(T_('Add new category'));

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
			$args['i_cat.status'] = \dash\request::get('status');
			$filterArgs['Status'] = \dash\request::get('status');
		}

		if(\dash\request::get('title'))
		{
			$args['i_cat.title'] = \dash\request::get('title');
			$filterArgs['Title'] = \dash\request::get('title');
		}

		if(array_key_exists('in', $_GET))
		{
			if(\dash\request::get('in'))
			{
				$args['i_cat.in'] = 1;
				$filterArgs['User in incomming'] = 'Yes';
			}
			else
			{
				$args['i_cat.in'] = null;
				$filterArgs['User in incomming'] = 'No';
			}
		}

		if(array_key_exists('parent', $_GET))
		{
			if(\dash\request::get('in'))
			{
				$parent1 = \dash\coding::decode(\dash\request::get('parent'));
				if($parent1)
				{
					$args['i_cat.parent1'] = $parent1;
				}
			}
			else
			{
				$args['i_cat.parent1'] = null;
				$filterArgs['Parent'] = 'Whitout parent';

			}
		}


		$sortLink  = \dash\app\sort::make_sortLink(\lib\app\category::$sort_field, \dash\url::this());
		$dataTable = \lib\app\category::list(\dash\request::get('q'), $args);

		\dash\data::sortLink($sortLink);
		\dash\data::dataTable($dataTable);

		if(isset($args['i_cat.parent1']) && isset($dataTable[0]['parent_title']))
		{
			$filterArgs['Parent'] = $dataTable[0]['parent_title'];
		}


		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArgs);
		\dash\data::dataFilter($dataFilter);
	}
}
?>