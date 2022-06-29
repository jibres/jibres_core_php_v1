<?php
namespace content_a\form\tag;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Form Tags'));


		\dash\data::action_text(T_('Add new tag'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::that(). '/add'. \dash\request::full_get());


		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here(). '/form/edit?id='. \dash\request::get('id'));


		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
			'form_id' => \dash\request::get('id'),
		];


		$search_string = \dash\validate::search_string();

		// work with tag list
		$myTagList = \lib\app\form\tag\search::list($search_string, $args);

		\dash\data::dataTable($myTagList);

		\dash\data::filterBox(\lib\app\form\tag\search::filter_message());

		$isFiltered = \lib\app\form\tag\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . ' | '. T_('Filtered'));
		}

		\content_a\form\edit\view::form_preview_link();

	}
}
?>