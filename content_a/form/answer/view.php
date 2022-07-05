<?php
namespace content_a\form\answer;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Answers'). ' | '. \dash\data::formDetail_title());

		// back
				// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));


		\dash\face::btnExport(\dash\url::that(). '/export?id='. \dash\request::get('id'));

		\content_a\form\edit\view::form_preview_link();

		\dash\data::listEngine_start(true);

		\dash\data::listEngine_before(__DIR__. '/display-before.php');

		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\form\answer\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\form\answer\filter::sort_list());
		\dash\data::listEngine_cleanFilterUrl(\dash\url::that(). '?id='. \dash\request::get('id'));
		\dash\data::listEngine_newActionByCurrentFilterURL(\dash\url::that(). '/grouptag'. \dash\request::full_get());
		\dash\data::listEngine_newActionByCurrentFilterTitle(T_("Add tag by this result"));


		$args                = [];
		$args['sort']        = \dash\request::get('sort');
		$args['order']       = \dash\request::get('order');
		$args['form_id']     = \dash\request::get('id');
		$args['tag_id']      = \dash\request::get('tagid');

		if(\dash\request::get('status'))
		{
			$args['status'] = \dash\request::get('status');
		}

		if(\dash\request::get('std'))
		{
			$args['start_date'] = \dash\request::get('std');
		}

		if(\dash\request::get('end'))
		{
			$args['end_date'] = \dash\request::get('end');
		}

		$args['not_deleted'] = true;
		$q               = \dash\validate::search_string();


		if(\dash\data::getFilterArgsInModel())
		{
			return $args;
		}

		$dataTable = \lib\app\form\answer\search::list($q, $args);

		$filterBox     = \lib\app\form\answer\search::filter_message();
		$isFiltered    = \lib\app\form\answer\search::is_filtered();


		$count_not_reviewed = \lib\app\form\answer\get::count_not_reviewd(\dash\request::get('id'));
		\dash\data::countNotReviewed($count_not_reviewed);

		$isFiltered = \lib\app\form\answer\search::is_filtered();

		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

	}

}
?>