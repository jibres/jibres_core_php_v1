<?php
namespace content_a\form\find\print;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Print Result'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this() . '/find?id=' . \dash\request::get('id'));

		$form_id   = \dash\request::get('id');
		$answer_id = \dash\request::get('aid');
		$args = [];

		$args['answer_id']    = \dash\request::get('aid');
		$args['form_id']      = \dash\request::get('id');
		$args['sort_by_item'] = true;

		$q = \dash\validate::search_string();

		$dataTable = \lib\app\form\answerdetail\search::list(null, $args);

		$filterBox  = \lib\app\form\answerdetail\search::filter_message();
		$isFiltered = \lib\app\form\answerdetail\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

		$load_items = \lib\app\form\item\get::items_answer(\dash\request::get('id'), \dash\request::get('aid'));

		\dash\data::formItems($load_items);


		$tag_list = \lib\app\form\tag\get::answer_tag(\dash\request::get('aid'));

		if (!is_array($tag_list))
		{
			$tag_list = [];
		}
		\dash\data::tagsSavedID(array_column($tag_list, 'form_tag_id'));
		\dash\data::tagsSavedTitle(array_column($tag_list, 'title'));


		$comment_list = \lib\app\form\comment\get::get(\dash\request::get('aid'));
		\dash\data::commentList($comment_list);

		$load_answer = \lib\app\form\answer\get::by_id(\dash\request::get('aid'));
		\dash\data::answerDetail($load_answer);

		if (isset($load_answer['transaction_id']) && $load_answer['transaction_id'])
		{
			\dash\data::answerTransactionDetail(\dash\app\transaction\get::get(($load_answer['transaction_id'])));
		}



		\dash\face::btnPrint(true);


	}


}

?>
