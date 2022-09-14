<?php
namespace content_love\plan\datalist;


class view
{

	public static function config()
	{
		\dash\face::title(T_("Business plans"));

		// btn
		\dash\data::back_text(T_('Plan'));
		\dash\data::back_link(\dash\url::this());

		if($business_id = \dash\request::get('business_id'))
		{
			\dash\data::action_text(T_('Add plan'));
			\dash\data::action_link(\dash\url::this() . '/add?business_id=' . $business_id);
		}

		\dash\data::listEngine_start(true);

		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\plan\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\plan\filter::sort_list());

		$args =
			[
				'order'       => \dash\request::get('order'),
				'sort'        => \dash\request::get('sort'),
				'user'        => \dash\request::get('user'),
				'plan'        => \dash\request::get('plan'),
				'periodtype'  => \dash\request::get('periodtype'),
				'action'      => \dash\request::get('action'),
				'reason'      => \dash\request::get('reason'),
				'setby'       => \dash\request::get('setby'),
				'business_id' => \dash\request::get('business_id'),
				'status'      => \dash\request::get('status'),
			];

		$search_string = \dash\validate::search_string();



		$list = \lib\app\plan\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$isFiltered = \lib\app\plan\search::is_filtered();

		\dash\data::isFiltered($isFiltered);


	}

}
