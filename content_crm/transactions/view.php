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

		\dash\face::btnSetting(\dash\url::this() . '/report');

		// btn
		// \dash\data::action_text(T_('Add New Transaction'));
		// \dash\data::action_icon('plus');
		// \dash\data::action_link(\dash\url::this(). '/add');

		$statistics_file = root . 'content_crm/transactions/display-statistics.php';

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\dash\app\transaction\filter::list(\dash\url::module(), $statistics_file));
		\dash\data::listEngine_sort(true);

		\dash\data::sortList(\dash\app\transaction\filter::sort_list());

		$args =
			[
				'order'         => \dash\request::get('order'),
				'sort'          => \dash\request::get('sort'),
				'status'        => \dash\request::get('status'),
				'verify'        => \dash\request::get('verify'),
				'user_code'     => \dash\request::get('user'),
				'charge_type'   => \dash\request::get('ct'),
				'by_form'       => \dash\request::get('bf'),
				'start_date'    => \dash\request::get('std'),
				'end_date'      => \dash\request::get('end'),
				'need_calc_sum' => 1,
			];

		$TransactioArgsSearch = \dash\temp::get('TransactioArgsSearch');
		if(is_array($TransactioArgsSearch))
		{
			$args = array_merge($args, $TransactioArgsSearch);
		}


		$search_string   = \dash\validate::search_string();
		$transactionList = \dash\app\transaction\search::list($search_string, $args);

		\dash\data::dataTable($transactionList);

		$isFiltered = \dash\app\transaction\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  ' . T_('Filtered'));
		}

		$calcSum = \dash\temp::get('transactionCalcSum');
		\dash\data::calcSum($calcSum);
	}

}

?>