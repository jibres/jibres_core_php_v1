<?php
namespace content_cms\attachment\home;


class view
{
	public static function config()
	{

		\dash\face::title(T_("Attachments"));

		\dash\data::action_text(T_('Add new attachment'));
		\dash\data::action_link(\dash\url::this(). '/add');

		\dash\data::back_text(T_('CMS'));
		\dash\data::back_link(\dash\url::here());



		\dash\data::listEngine_start(true);
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(false);

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
		];



		$postList      = \dash\app\files\search::list(null, $args);

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