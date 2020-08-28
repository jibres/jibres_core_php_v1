<?php
namespace content_a\form\answer\item;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Answer Detail'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this() . '/report?id='. \dash\request::get('id'));

		$args            = [];

		$args['item_id'] = \dash\request::get('iid');
		$args['form_id'] = \dash\request::get('id');

		$q = \dash\request::get('q');

		$dataTable = \lib\app\form\answerdetail\search::list($q, $args);

		$filterBox     = \lib\app\form\answerdetail\search::filter_message();
		$isFiltered    = \lib\app\form\answerdetail\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

	}

}
?>
