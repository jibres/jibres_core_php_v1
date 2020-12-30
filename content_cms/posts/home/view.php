<?php
namespace content_cms\posts\home;


class view
{
	public static function config()
	{
		$myTitle = T_("Posts");
		$subtype = \dash\request::get('subtype');

		switch ($subtype)
		{
			case 'standard':
				$myTitle .= ' | '. T_("Standard");
				\dash\data::action_text(T_('Add new post'));
				\dash\data::action_link(\dash\url::this(). '/add?subtype=standard');
				break;

			case 'gallery':
				$myTitle .= ' | '. T_("Gallery");
				\dash\data::action_text(T_('Add new gallery'));
				\dash\data::action_link(\dash\url::this(). '/add?subtype=gallery');
				break;

			case 'video':
				$myTitle .= ' | '. T_("Video");
				\dash\data::action_text(T_('Add new video'));
				\dash\data::action_link(\dash\url::this(). '/add?subtype=video');
				break;

			case 'audio':
				$myTitle .= ' | '. T_("Gallery");
				\dash\data::action_text(T_('Add new podcast'));
				\dash\data::action_link(\dash\url::this(). '/add?subtype=audio');
				break;

			default:
				\dash\data::action_text(T_('Add new post'));
				\dash\data::action_link(\dash\url::this(). '/addo');
				break;
		}

		\dash\face::title($myTitle);
		\dash\data::back_text(T_('CMS'));
		\dash\data::back_link(\dash\url::here());


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(false);

		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
			'status'  => \dash\request::get('status'),
			'subtype' => $subtype,
			'cat_id'  => \dash\request::get('categoryid'),
			'tag_id'  => \dash\request::get('tagid'),
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