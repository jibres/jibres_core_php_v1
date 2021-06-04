<?php
namespace content_love\email\history;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Email history"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(false);

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),

		];

		$search_string = \dash\validate::search_string();

		$list = \dash\email\history::list($search_string, $args);

		\dash\data::dataTable($list);

		$isFiltered = \dash\email\history::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
