<?php
namespace content_love\gift\all;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Gift cards"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\gift\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\gift\filter::sort_list());


		$args =
		[
			'order'    => \dash\request::get('order'),
			'sort'     => \dash\request::get('sort'),
			'status'   => \dash\request::get('status'),
			'user'     => \dash\request::get('user'),
			'type'     => \dash\request::get('type'),
			'forusein' => \dash\request::get('forusein'),
		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\gift\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$isFiltered = \lib\app\gift\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

	}
}
?>
