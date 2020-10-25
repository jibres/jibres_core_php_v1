<?php
namespace content_a\form\answer\detail;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Answer Detail'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that() . '?id='. \dash\request::get('id'));

		$args              = [];

		$args['answer_id'] = \dash\request::get('aid');
		$args['form_id']   = \dash\request::get('id');

		$q = \dash\request::get('q');

		$dataTable = \lib\app\form\answerdetail\search::list($q, $args);

		$filterBox     = \lib\app\form\answerdetail\search::filter_message();
		$isFiltered    = \lib\app\form\answerdetail\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

		$load_items = \lib\app\form\item\get::items_answer(\dash\request::get('id'), \dash\request::get('aid'));

		\dash\data::formItems($load_items);

		// \dash\face::btnSave('form1');

		$all_tag = \lib\app\form\tag\get::all_tag();
		\dash\data::allTagList($all_tag);


		$tag_list = \lib\app\form\tag\get::answer_tag(\dash\request::get('aid'));
		if(!is_array($tag_list))
		{
			$tag_list = [];
		}
		\dash\data::tagsSavedTitle(array_column($tag_list, 'title'));


		$comment_list = \lib\app\form\comment\get::get(\dash\request::get('aid'));

		\dash\data::commentList($comment_list);
	}

}
?>
