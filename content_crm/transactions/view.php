<?php
namespace content_crm\transactions;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Transactions"));

		// back
		\dash\data::back_text(T_('CRM'));
		\dash\data::back_link(\dash\url::here());

		// btn
		\dash\data::action_text(T_('Add New Transaction'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::this(). '/add');

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(true);


		$search_string            = \dash\request::get('q');
		if($search_string)
		{
			\dash\face::title(\dash\face::title() . ' | '. T_('Search for :search', ['search' => $search_string]));
		}

		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];

		if(!$args['sort'])
		{
			$args['sort'] = 'transactions.id';
		}

		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}

		if(\dash\request::get('status'))
		{
			$args['transactions.status'] = \dash\request::get('status');
		}

		if(\dash\request::get('condition'))
		{
			$args['condition'] = \dash\request::get('condition');
		}

		if(\dash\request::get('payment'))
		{
			$args['payment'] = \dash\request::get('payment');
		}

		if(\dash\request::get('type'))
		{
			$args['transactions.type'] = \dash\request::get('type');
		}
		$dataTable = \dash\app\transaction::list(\dash\request::get('q'), $args);

		\dash\data::sortLink(\content_su\view::su_make_sortLink(\dash\app\transaction::$sort_field, \dash\url::this()));
		\dash\data::dataTable($dataTable);

		$check_empty_datatable = $args;
		unset($check_empty_datatable['sort']);
		unset($check_empty_datatable['order']);

		// set dataFilter
		\dash\data::dataFilter(\content_su\view::su_createFilterMsg($search_string, $check_empty_datatable));
	}
}
?>