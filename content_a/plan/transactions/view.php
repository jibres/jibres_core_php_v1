<?php
namespace content_a\plan\transactions;


class view
{

	public static function config()
	{
		\dash\face::title(T_("Plan Transaction history"));

		// back
		\dash\data::back_text(T_('Plan'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\dash\app\transaction\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\dash\app\transaction\filter::sort_list());

		$search_string = \dash\validate::search_string();
		$args          =
			[
				'caller'      => 'business:plan',
				'store_id'    => \lib\store::id(),
				'order'       => \dash\request::get('order'),
				'sort'        => \dash\request::get('sort'),
				'status'      => \dash\request::get('status'),
				'verify'      => \dash\request::get('verify'),
				'user_code'   => \dash\request::get('user'),
				'charge_type' => \dash\request::get('ct'),
				'start_date'  => \dash\request::get('std'),
				'end_date'    => \dash\request::get('end'),
				'q'           => $search_string,
			];

		$transactionList = \lib\api\jibres\api::transaction_list($args);

		\dash\data::dataTable($transactionList);


	}

}
