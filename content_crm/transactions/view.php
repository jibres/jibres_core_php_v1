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
		// \dash\data::action_text(T_('Add New Transaction'));
		// \dash\data::action_icon('plus');
		// \dash\data::action_link(\dash\url::this(). '/add');

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(false);

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'status' => \dash\request::get('status'),
		];

		$search_string   = \dash\validate::search(\dash\request::get('q'));
		$transactionList = \dash\app\transaction\search::list($search_string, $args);

		\dash\data::dataTable($transactionList);

		$isFiltered = \dash\app\transaction\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}
	}
}
?>