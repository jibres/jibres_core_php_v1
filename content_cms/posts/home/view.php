<?php
namespace content_cms\posts\home;


class view
{
	public static function config()
	{
		$moduleTypeTxt = \dash\request::get('type');
		$moduleType    = '';

		if(\dash\request::get('type'))
		{
			$moduleType = '?type='. \dash\request::get('type');
		}

		\dash\data::moduleTypeTxt($moduleTypeTxt);
		\dash\data::moduleType($moduleType);

		$myType = \dash\request::get('type');

		$myTitle = T_("Posts");
		\dash\data::action_text(T_('Add new post'));
		\dash\data::action_link(\dash\url::this(). '/add'. $moduleType);

		if($myType === 'page')
		{
			$myTitle = T_('Pages');
			\dash\data::action_text(T_('Add new page'));
			\dash\data::action_link(\dash\url::this(). '/add'. $moduleType);

		}


		// \dash\data::listSpecial(\dash\app\posts\special::list());
		// add back level to summary link

		\dash\face::title($myTitle);


		\dash\data::back_text(T_('CMS'));
		\dash\data::back_link(\dash\url::here());


		$search_string = \dash\request::get('q');
		if($search_string)
		{
			$myTitle .= ' | '. T_('Search for :search', ['search' => $search_string]);
		}


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(false);

		$args =
		[
			'order'     => \dash\request::get('order'),
			'sort'      => \dash\request::get('sort'),
			'status'    => \dash\request::get('status'),

		];


		$search_string = \dash\validate::search(\dash\request::get('q'));
		$postList      = \dash\app\posts\search::list($search_string, $args);

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