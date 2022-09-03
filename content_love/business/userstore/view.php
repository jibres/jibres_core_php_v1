<?php
namespace content_love\business\userstore;


class view
{
	public static function config()
	{
		\dash\face::title(T_("User store"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\store\filter::list(\dash\url::child()));
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\store\filter::sort_list());

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'user'   => \dash\request::get('user'),

		];


		$search_string   = \dash\validate::search_string();
		$list = \lib\app\store_user\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$isFiltered = \lib\app\store\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
