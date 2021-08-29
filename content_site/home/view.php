<?php
namespace content_site\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Site Builder'));

		\dash\data::action_text(T_('Add New Page'));
		\dash\data::action_link(\dash\url::this(). '/page/new');

		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::kingdom(). '/a');

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\dash\app\posts\filter::list('pagebuilder'));
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\dash\app\posts\filter::sort_list('pagebuilder'));

		$args =
		[
			// 'order'       => \dash\request::get('order'),
			// 'sort'        => \dash\request::get('sort'),
			// 'status'      => \dash\request::get('status'),
			'type'        => 'pagebuilder',

			// 'pd'      => \dash\request::get('pd'),
			// 'g'       => \dash\request::get('g'),
			// 'fi'      => \dash\request::get('fi'),
			// 'co'      => \dash\request::get('co'),
			// 'seo'     => \dash\request::get('seo'),
			// 'sa'      => \dash\request::get('sa'),
			// 'com'     => \dash\request::get('com'),
			// 't'       => \dash\request::get('t'),
			// 'r'       => \dash\request::get('r'),
		];

		$search_string = \dash\validate::search_string();
		$postList      = \dash\app\posts\search::list($search_string, $args, true);

		\dash\data::dataTable($postList);

		$isFiltered = \dash\app\posts\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}

}
?>