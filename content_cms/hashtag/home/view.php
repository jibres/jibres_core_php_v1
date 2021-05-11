<?php
namespace content_cms\hashtag\home;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Hashtags'));


		\dash\data::action_text(T_('Add new Hashtag'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::this(). '/add');


		\dash\data::back_text(T_('CMS'));
		\dash\data::back_link(\dash\url::here());


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(false);


		$args =
		[
			'order' => \dash\request::get('order'),
			'sort'  => \dash\request::get('sort'),
			'type'  => 'tag',
		];


		$search_string = \dash\request::get('q');

		// work with category list
		$myCategoryList = \dash\app\terms\search::list($search_string, $args);

		\dash\data::dataTable($myCategoryList);

		$isFiltered = \dash\app\terms\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . ' | '. T_('Filtered'));
		}

	}
}
?>