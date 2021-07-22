<?php
namespace content_love\changelog;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Changelog"));
		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		// btn
		\dash\data::action_text(T_('Add'));
		\dash\data::action_link(\dash\url::this(). '/add');


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(false);

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'tag'   => \dash\request::get('tag'),

		];

		$search_string = \dash\validate::search_string();

		$list = \dash\app\changelog::list($search_string, $args);

		\dash\data::dataTable($list);

		$isFiltered = \dash\app\changelog::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>