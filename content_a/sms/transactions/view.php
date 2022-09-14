<?php
namespace content_a\sms\transactions;


class view
{

	public static function config()
	{
		\dash\face::title(T_("sms Transaction history"));

		// back
		\dash\data::back_text(T_('sms'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		// \dash\data::listEngine_filter(\dash\app\transaction\filter::list());
		// \dash\data::listEngine_sort(true);
		// \dash\data::sortList(\dash\app\transaction\filter::sort_list());

		$search_string = \dash\validate::search_string();
		$args          =
			[
				'caller'      => 'business:sms',
				'store_id'    => \lib\store::id(),
				// 'order'       => \dash\request::get('order'),
				// 'sort'        => \dash\request::get('sort'),
				// 'status'      => \dash\request::get('status'),
				'verify'      => 'y',
				'charge_type' => 'n',
				// 'user_code'   => \dash\request::get('user'),
				// 'charge_type' => \dash\request::get('ct'),
				// 'start_date'  => \dash\request::get('std'),
				// 'end_date'    => \dash\request::get('end'),
				'page'        => \dash\request::get('page'),
				'q'           => $search_string,
			];

		$result = \lib\api\jibres\api::transaction_list($args);

		$dataTable = a($result, 'result');

		if(!is_array($dataTable))
		{
			$dataTable = [];
		}

		\dash\data::dataTable($dataTable);

		$pagenation = a($result, 'pagination');
		$isFiltered = a($result, 'meta', 'is_filtered');

		\dash\utility\pagination::initFromAPI($pagenation);


	}

}
