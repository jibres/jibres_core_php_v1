<?php
namespace content_a\factor\home;


class view
{
	public static function config()
	{

		self::set_best_title();

		$args =
		[
			'order'        => \dash\request::get('order'),
			'sort'         => \dash\request::get('sort'),
			'load_product' => true,
		];

		$filterArgs = [];
		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}

		if(\dash\request::get('type'))
		{
			$args['factors.type']       = \dash\request::get('type');
			$filterArgs['type'] = \dash\request::get('type');
		}

		if(\dash\request::get('customer'))
		{
			$args['factors.customer'] = \dash\request::get('customer');
		}

		if(isset($args['factors.customer']) && $args['factors.customer'] === '-quick')
		{
			$args['factors.customer'] = null;
		}


		$dataTable = \lib\app\factor::list(\dash\request::get('q'), $args);
		\dash\data::dataTable($dataTable);

		if(isset($args['factors.customer']))
		{
			$customer_name = '';
			if(isset($dataTable[0]['customer_firstname']))
			{
				$customer_name .= $dataTable[0]['customer_firstname'];
			}

			if(isset($dataTable[0]['customer_lastname']))
			{
				$customer_name .=  ' '. $dataTable[0]['customer_lastname'];
			}

			if(isset($dataTable[0]['customer_displayname']))
			{
				$customer_name .= ' '. $dataTable[0]['customer_displayname'];
			}

			$filterArgs['customer'] = $customer_name;
		}

		\dash\data::myFilter(\content_a\filter::current(\lib\app\factor::$sort_field, \dash\url::this()));

		\dash\data::filterBox(\dash\app\sort::createFilterMsg(\dash\request::get('q'), $filterArgs));

		$dashboard_detail = \lib\app\factor\dashboard::detail();
		\dash\data::dashboardDetail($dashboard_detail);


	}


	private static function set_best_title()
	{
		// set usable variable
		$moduleType = \dash\request::get('type');

		\dash\data::moduleType($moduleType);
		\dash\data::moduleTypeP('?type='.$moduleType);


		// set default title
		$myTitle     = T_('List of factors');
		$myDesc      = T_('You can search in list of factors, add new factor or edit existing.');
		// set badge
		$myBadgeLink = \dash\url::here();
		$myBadgeText = T_('Back to dashboard');


		// // for special condition
		if($moduleType)
		{
			$myTitle     = T_('List of :type', ['type' => T_($moduleType)]);
			$myDesc      = T_('Search in list of :type factors, add or edit them.', ['type' => T_($moduleType)]);
			$myDesc      .= ' <a href="'. \dash\url::this() .'" data-shortkey="121">'. T_('List of all factors.'). '<kbd>f10</kbd></a>';

			switch ($moduleType)
			{
				case 'buy':
					\dash\permission::access('factorBuyList');
					$myBadgeLink = \dash\url::here(). '/'. $moduleType;
					$myBadgeText = T_('Add new :type', ['type' => T_($moduleType)]);
					break;

				case 'sale':
					\dash\permission::access('factorSaleList');
					$myBadgeLink = \dash\url::here(). '/'. $moduleType;
					$myBadgeText = T_('Add new :type', ['type' => T_($moduleType)]);
					break;

				default:
					# code...
					break;
			}
		}

		\dash\data::page_title($myTitle);
		\dash\data::page_desc($myDesc);

		\dash\data::badge_text($myBadgeText);
		\dash\data::badge_link($myBadgeLink);
	}
}
?>
