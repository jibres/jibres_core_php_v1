<?php
namespace content_cms\files\choose;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Files"));

		self::call_back_link();


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


	public static function call_back_link()
	{
		if(\dash\request::get('related') === 'poststhumb' && \dash\request::get('related_id'))
		{
			$link = \dash\url::here(). '/posts/edit?id='. \dash\request::get('related_id');
			$title = T_("Edit post");
		}
		elseif(\dash\request::get('related') === 'postscover' && \dash\request::get('related_id'))
		{
			$link = \dash\url::here(). '/posts/setting?id='. \dash\request::get('related_id');
			$title = T_("Post setting");
		}
		else
		{
			$link = \dash\url::here();
			$title = T_("CMS");
		}


		\dash\data::back_text($title);
		\dash\data::back_link($link);

		return $link;
	}
}
?>