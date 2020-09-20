<?php
namespace content_a\form\analytics\addfilter;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Analitics'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?id='. \dash\request::get('id'));


		$table_name = \lib\app\form\view\get::is_created_table(\dash\request::get('id'));

		if(!$table_name)
		{
			\dash\header::status(404, T_("Table not created"));
		}

		$fields = \lib\app\form\form\ready::fields(\dash\data::formDetail());

		\dash\data::fields($fields);
		$args            = [];
		$args['sort']    = 'id';
		$args['order']   = 'desc';
		$args['table_name'] = $table_name;
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
