<?php
namespace content_a\form\answer\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit answer'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that() . '/detail'. \dash\request::full_get());

		$args              = [];

		$args['answer_id'] = \dash\request::get('aid');
		$args['form_id']   = \dash\request::get('id');

		$q = \dash\validate::search_string();

		$dataTable = \lib\app\form\answerdetail\search::list($q, $args);

		$filterBox     = \lib\app\form\answerdetail\search::filter_message();
		$isFiltered    = \lib\app\form\answerdetail\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

		$load_items = \lib\app\form\item\get::items_answer(\dash\request::get('id'), \dash\request::get('aid'));

		\dash\data::formItems($load_items);


	}

}
?>
