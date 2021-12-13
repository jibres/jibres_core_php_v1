<?php
namespace content_a\order\home;


class view
{
	public static function config()
	{

		self::set_best_title();

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\order\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\order\filter::sort_list());


		$search_string = \dash\validate::search_string();
		$args          = \lib\app\order\filter::fill_order_args_from_GET();

		if(\dash\url::child() === 'unprocessed')
		{
			$args['get_unprocessed'] = true;
		}



		\lib\app\back_btn\link::set_order();


		$dataTable = \lib\app\order\search::list($search_string, $args);
		if(!is_array($dataTable))
		{
			$dataTable = [];
		}

		\dash\data::dataTable($dataTable);


		if(count(array_filter(array_column($dataTable, 'subvat'))) === 0 )
		{
			\dash\data::hideSubvat(true);
		}

		if(count(array_filter(array_column($dataTable, 'shipping'))) === 0 )
		{
			\dash\data::hideShipping(true);
		}


		$isFiltered = \lib\app\order\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}



	}


	private static function set_best_title()
	{
		// set usable variable
		$moduleType = \dash\request::get('type');

		\dash\data::moduleType($moduleType);
		\dash\data::moduleTypeP('?type='.$moduleType);


		// set default title
		$myTitle     = T_('List of orders');
		$myDesc      = T_('You can search in list of orders, add new factor or edit existing.');
		// set badge
		$myBadgeLink = \dash\url::here();
		$myBadgeText = T_('Back to dashboard');


		// // for special condition
		if($moduleType)
		{
			$myTitle     = T_('List of :type', ['type' => T_($moduleType)]);
			$myDesc      = T_('Search in list of :type orders, add or edit them.', ['type' => T_($moduleType)]);

			switch ($moduleType)
			{
				case 'buy':
					$myBadgeLink = \dash\url::here(). '/'. $moduleType;
					$myBadgeText = T_('Add new :type', ['type' => T_($moduleType)]);
					break;

				case 'sale':
					$myBadgeLink = \dash\url::here(). '/'. $moduleType;
					$myBadgeText = T_('Add new :type', ['type' => T_($moduleType)]);
					break;

				default:
					# code...
					break;
			}
		}

		\dash\face::title($myTitle);

		\dash\data::action_text(T_("Add new order"));
		\dash\data::action_link(\dash\url::kingdom(). '/a/sale');

		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());
	}
}
?>
