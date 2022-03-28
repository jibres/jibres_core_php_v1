<?php
namespace content_a\discount\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Discount code"));

		\dash\data::action_text(T_('Add New Discount code'));
		\dash\data::action_link(\dash\url::this(). '/add');

		// back
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());
		// \dash\data::back_direct(true);

		\dash\data::include_m2(true);


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\discount\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\discount\filter::sort_list());

		$args =
		[
			'order'       => \dash\request::get('order'),
			'sort'        => \dash\request::get('sort'),
			'status'      => \dash\request::get('status'),

		];

		$search_string = \dash\validate::search_string();
		$postList      = \lib\app\discount\search::list($search_string, $args, true);

		\dash\data::dataTable($postList);

		$isFiltered = \lib\app\discount\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}


	}
}
?>
