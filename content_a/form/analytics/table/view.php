<?php
namespace content_a\form\analytics\table;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Analitics'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		// var_dump(\dash\data::formDetail());
		// var_dump(\dash\data::viewDetail());
		// var_dump(\dash\data::viewFieldDetail());
		// exit();

		$fields = array_column(\dash\data::viewFieldDetail(), 'field_title', 'field_md5');
		\dash\data::fields($fields);
		$args            = [];
		$args['sort']    = 'id';
		$args['order']   = 'desc';
		$args['table_name'] = \dash\data::viewDetail_table_name();
		$q               = \dash\request::get('q');


		$dataTable = \lib\app\form\view\search_table::list($q, $args);



		$filterBox     = \lib\app\form\view\search::filter_message();
		$isFiltered    = \lib\app\form\view\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

	}

}
?>
