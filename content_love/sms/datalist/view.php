<?php
namespace content_love\sms\datalist;


class view
{

	public static function config()
	{
		\dash\face::title(T_("Sms list"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\sms\filter::list());

		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\sms\filter::sort_list());

		$args =
			[
				'order'          => \dash\request::get('order'),
				'sort'           => \dash\request::get('sort'),
				'status'         => \dash\request::get('status'),
				'calculate_cost' => \dash\request::get('calculate_cost'),
				'store_id'       => \dash\request::get('business_id'),

			];

		$search_string = \dash\validate::search_string();


		$list = \lib\app\sms\search::jibres_list($search_string, $args);

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
