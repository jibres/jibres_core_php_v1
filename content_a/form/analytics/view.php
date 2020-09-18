<?php
namespace content_a\form\analytics;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Analitics'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		$args            = [];
		$args['sort']    = 'id';
		$args['order']   = 'desc';
		$args['form_id'] = \dash\request::get('id');
		$q               = \dash\request::get('q');


		$dataTable = \lib\app\form\view\search::list($q, $args);


		$filterBox     = \lib\app\form\view\search::filter_message();
		$isFiltered    = \lib\app\form\view\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

	}

}
?>
