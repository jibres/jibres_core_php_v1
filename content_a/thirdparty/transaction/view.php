<?php
namespace content_a\thirdparty\transaction;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Transactions'));
		\dash\data::page_desc(T_('Check all transactions include sales, purchases and money send and recieve.'));
		\dash\data::page_pictogram('balance-scale');

		\content_a\thirdparty\load::fixTitle();

		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];

		if(!$args['order'])
		{
			$args['order'] = 'desc';
		}

		if(\dash\request::get('paytype'))
		{
			$args['paytype'] = \dash\request::get('paytype');
		}

		$args['userstore_id'] = \dash\coding::decode(\dash\request::get('id'));
		$args['storetransactions.status']        = 'enable';

		$sortLink  = \dash\app\sort::make_sortLink(\lib\app\storetransaction::$sort_field, \dash\url::this());
		$dataTable = \lib\app\storetransaction::list(\dash\request::get('q'), $args);

		\dash\data::sortLink($sortLink);
		\dash\data::dataTable($dataTable);

		$check_empty_datatable = $args;
		unset($check_empty_datatable['sort']);
		unset($check_empty_datatable['order']);
		unset($check_empty_datatable['userstore_id']);
		unset($check_empty_datatable['storetransactions.status']);

		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg(null, $check_empty_datatable);
		\dash\data::dataFilter($dataFilter);
	}
}
?>
