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

		\dash\face::btnSetting(\dash\url::this(). '/report');

		// btn
		// \dash\data::action_text(T_('Add New Transaction'));
		// \dash\data::action_icon('plus');
		// \dash\data::action_link(\dash\url::this(). '/add');

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\dash\app\transaction\filter::list(\dash\url::child()));
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\dash\app\transaction\filter::sort_list());

		$args =
		[
			'order'     => \dash\request::get('order'),
			'sort'      => \dash\request::get('sort'),
			'status'    => \dash\request::get('status'),
			'verify'    => \dash\request::get('verify'),
			'show_type' => 'verify',
		];

		if(\dash\url::child() === 'all')
		{
			$args['show_type'] = 'all';
		}

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