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
		\dash\data::listEngine_filter(true);
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\dash\app\posts\filter::sort_list());

		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
			'status'  => \dash\request::get('status'),
			'subtype' => $subtype,
			'tag_id'  => \dash\request::get('tagid'),

			'pd'      => \dash\request::get('pd'),
			'g'       => \dash\request::get('g'),
			'fi'      => \dash\request::get('fi'),
			'co'      => \dash\request::get('co'),
			'seo'     => \dash\request::get('seo'),
			'sa'      => \dash\request::get('sa'),
			'com'     => \dash\request::get('com'),
			't'       => \dash\request::get('t'),
			'r'       => \dash\request::get('r'),
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