<?php
namespace content_site\gallery;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Choose from files"));

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\request::get('callback'));

		\dash\data::include_m2('wide');

		\dash\data::include_adminPanelBuilder(true);

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\dash\app\files\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::listEngine_cleanFilterUrl(\dash\url::that(). \dash\request::full_get(['q' => null, 'type' => null, 'ratio' => null]));
		\dash\data::listEngine_before(__DIR__. '/dispaly-fileaddr.php');

		\dash\data::sortList(\dash\app\files\filter::sort_list());
		$args =
		[
			'order' => \dash\request::get('order'),
			'sort'  => \dash\request::get('sort'),
			'type'  => \dash\request::get('type'),
			'ext'   => \dash\request::get('ext'),
			'ratio' => \dash\request::get('ratio'),
			'limit' => 30,
		];

		$postList      = \dash\app\files\search::list(\dash\validate::search_string(), $args);

		\dash\data::dataTable($postList);

		$isFiltered = \dash\app\files\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}
	}


}
?>