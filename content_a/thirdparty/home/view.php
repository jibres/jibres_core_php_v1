<?php
namespace content_a\thirdparty\home;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_(':type list', ['type' => T_(\content_a\thirdparty\load::typeTrans(true))]));
		\dash\data::page_desc(T_('Check list of :types and search or filter in them to find your :type.', ['types' => T_(\content_a\thirdparty\load::typeTrans(true)), 'type' => T_(\content_a\thirdparty\load::typeTrans())]));
		\dash\data::page_desc(\dash\data::page_desc(). ' '. T_('Also add or edit specefic :type.', ['type' => T_(\content_a\thirdparty\load::typeTrans())]));

		\dash\data::page_pictogram('users');

		$type = \content_a\thirdparty\load::typeTrans();
		// set pictogram
		switch ($type)
		{
			case 'customer':
				\dash\data::page_pictogram('user-4');
				break;

			case 'staff':
				\dash\data::page_pictogram('user-md');
				break;

			case 'supplier':
				\dash\data::page_pictogram('network');
				break;

			default:
				break;
		}

		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];


		if($type && \dash\request::get('type'))
		{
			$type_uc   = ucfirst(mb_strtolower($type));
			$caller    = "{$type_uc}Access";
			$callerAdd = "{$type_uc}Add";
			\dash\permission::access($caller);
		}
		else
		{

			if(\dash\permission::check("customerAccess") || \dash\permission::check("supplierAccess") || \dash\permission::check("staffAccess"))
			{
				$perm_query = [];

				if(\dash\permission::check("customerAccess"))
				{
					$perm_query[] = ' userstores.customer = 1 ';
				}
				if(\dash\permission::check("supplierAccess"))
				{
					$perm_query[] = ' userstores.supplier = 1 ';
				}

				if(\dash\permission::check("staffAccess"))
				{
					$perm_query[] = ' userstores.staff = 1 ';
				}

				if(count($perm_query) < 3)
				{
					$perm_query = implode(' OR ', $perm_query);
					$args['1.1'] = [" = 1.1 ", " AND ($perm_query)"];
				}
			}
			else
			{
				\dash\header::status(403, T_("Permission denied"));
			}
		}


		if($type && \dash\request::get('type'))
		{
			if(\dash\permission::check($callerAdd))
			{
				\dash\data::badge_link(\dash\url::this(). '/add');
				if($type)
				{
					\dash\data::badge_link(\dash\data::badge_link(). '?type='.$type);
				}
				\dash\data::badge_text(T_('Add new :type', ['type' => T_(\content_a\thirdparty\load::typeTrans())]));
			}
		}
		else
		{
			if(\dash\permission::check("customerAdd") || \dash\permission::check("supplierAdd") || \dash\permission::check("staffAdd"))
			{
				\dash\data::badge_link(\dash\url::this(). '/add');
				\dash\data::badge_text(T_("Add new thirdparty"));
			}
		}

		$search_string            = \dash\request::get('q');

		if($search_string)
		{
			\dash\data::page_title(\dash\data::page_title(). ' | '. T_('Search for :search', ['search' => $search_string]));
		}

		if(!$args['order'])
		{
			$args['order'] = 'desc';
		}

		if(\dash\request::get('status'))
		{
			$args['status'] = \dash\request::get('status');
		}

		if(\dash\request::get('type'))
		{
			$args['type'] = \dash\request::get('type');
		}


		$sortLink = \dash\app\sort::make_sortLink(\lib\app\thirdparty::$sort_field, \dash\url::this());
		$dataTable = \lib\app\thirdparty::list(\dash\request::get('q'), $args);

		\dash\data::sortLink($sortLink);
		\dash\data::dataTable($dataTable);

		$check_empty_datatable = $args;
		unset($check_empty_datatable['sort']);
		unset($check_empty_datatable['order']);
		unset($check_empty_datatable['type']);

		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $check_empty_datatable);
		\dash\data::dataFilter($dataFilter);

		$dashboardData = \lib\app\store::dashboard_detail(\lib\store::id());
		\dash\data::dashboardData($dashboardData);
	}


	private static function set_best_title()
	{
		// set usable variable
		$moduleType  = \dash\request::get('type');

		// set default title
		$myTitle     = T_('List of third parties');
		$myDesc      = T_('All type of poeple or companies like customers, staffs and supplisers is known as third parties that work with your store is exist here');
		// set badge
		$myBadgeLink = \dash\url::this(). '/add';
		$myBadgeText = T_('Add new third party');


		// for special condition
		if($moduleType)
		{
			$myTitle     = T_('List of :type', ['type' => $moduleType.'s']);
			$myDesc      = T_('Search in list of :type, add and edit and manage them.', ['type' => $moduleType.'s']);
			$myDesc      .= ' <a href="'. \dash\url::this() .'" data-shortkey="121">'. T_('List of all third parties.'). '<kbd>f10</kbd></a>';


			$myBadgeLink = \dash\url::this(). '/add?type='. $moduleType;
			$myBadgeText = T_('Add new :type', ['type' => $moduleType]);
		}

		\dash\data::page_title($myTitle);
		\dash\data::page_desc($myDesc);

		\dash\data::badge_text($myBadgeText);
		\dash\data::badge_link($myBadgeLink);
	}
}
?>
