<?php
namespace content_cms\files\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Files"));

		\dash\data::action_text(T_('Upload'));
		\dash\data::action_link(\dash\url::this(). '/add');

		\dash\data::back_text(T_('CMS'));
		\dash\data::back_link(\dash\url::here());

		\dash\face::btnSetting(\dash\url::this(). '/setting');

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(true);
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\dash\app\files\filter::sort_list());

		$args =
		[
			'order' => \dash\request::get('order'),
			'sort'  => \dash\request::get('sort'),
			'type'  => \dash\request::get('type'),
			'ext'   => \dash\request::get('ext'),
		];

		$postList      = \dash\app\files\search::list(\dash\request::get('q'), $args);

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