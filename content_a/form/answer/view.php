<?php
namespace content_a\form\answer;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Answers'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\face::btnExport(\dash\url::that(). '/export?id='. \dash\request::get('id'));

		$args            = [];
		$args['sort']    = 'id';
		$args['order']   = 'desc';
		$args['form_id'] = \dash\request::get('id');
		$q               = \dash\request::get('q');

		$dataTable = \lib\app\form\answer\search::list($q, $args);

		$filterBox     = \lib\app\form\answer\search::filter_message();
		$isFiltered    = \lib\app\form\answer\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

	}

}
?>
