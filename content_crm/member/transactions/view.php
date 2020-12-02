<?php
namespace content_crm\member\transactions;

class view
{

	public static function config()
	{

		\content_crm\member\master::view();

		\dash\face::title(T_("Transactions"));

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(false);

		$args =
		[
			'order'     => \dash\request::get('order'),
			'sort'      => \dash\request::get('sort'),
			'show_type' => 'all',
			'user_code' => \dash\request::get('id'),
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