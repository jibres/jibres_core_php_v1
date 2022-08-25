<?php
namespace content_love\plan\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Business plans"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());


		\dash\data::listEngine_start(true);

		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\plan\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\plan\filter::sort_list());

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'user'   => \dash\request::get('user'),
			'status' => \dash\request::get('status'),

		];

		$search_string = \dash\validate::search_string();

		$list = \lib\app\plan\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$isFiltered = \lib\app\plan\search::is_filtered();

		\dash\data::isFiltered($isFiltered);



	}
}
?>
