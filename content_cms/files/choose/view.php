<?php
namespace content_cms\files\choose;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Choose from files"));

		self::call_back_link();


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\dash\app\files\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::listEngine_cleanFilterUrl(\dash\url::that().'?'. \dash\request::build_query(['related' => \dash\request::get('related'), 'related_id' => \dash\request::get('related_id')]));
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


	public static function call_back_link()
	{
		$related    = \dash\request::get('related');
		$related_id = \dash\request::get('related_id');

		if(in_array($related, ['poststhumb','postsgallery', 'postsgalleryvideo', 'postsgalleryaudio']) && $related_id)
		{
			$link  = \dash\url::here(). '/posts/edit?id='. $related_id;
			$title = T_("Edit post");
		}
		elseif($related === 'postscover' && $related_id)
		{
			if(\dash\request::get('bm') === 'pagebuilder')
			{
				$link  = \dash\url::kingdom(). '/a/pagebuilder/seo?id='. $related_id;
				$title = T_("Back");
			}
			else
			{
				$link  = \dash\url::here(). '/posts/advance?id='. $related_id;
				$title = T_("Post setting");
			}
		}
		else
		{
			$link  = \dash\url::here();
			$title = T_("CMS");
		}

		\dash\data::back_text($title);
		\dash\data::back_link($link);

		return $link;
	}
}
?>