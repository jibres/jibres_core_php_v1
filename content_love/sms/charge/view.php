<?php
namespace content_love\sms\charge;


class view
{

	public static function config()
	{
		\dash\face::title(T_("SMS charge list"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		// btn
		\dash\data::action_text(T_('Plus minus business charge'));
		\dash\data::action_link(\dash\url::that(). '/add');

		if($business_id = \dash\request::get('business_id'))
		{
			\dash\data::action_link(\dash\url::that(). '/add?business_id='. $business_id);
		}


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\sms_charge\filter::list());

		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\sms_charge\filter::sort_list());

		$args =
			[
				'order'          => \dash\request::get('order'),
				'sort'           => \dash\request::get('sort'),
				'status'         => \dash\request::get('status'),
				'calculate_cost' => \dash\request::get('calculate_cost'),
				'store_id'       => \dash\request::get('business_id'),

			];

		$search_string = \dash\validate::search_string();


		$list = \lib\app\sms_charge\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$isFiltered = \dash\app\changelog::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  ' . T_('Filtered'));
		}


	}

}

?>
