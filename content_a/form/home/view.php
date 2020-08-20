<?php
namespace content_a\form\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Contact form'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());



		$args = [];

		$q = \dash\request::get('q');

		$dataTable = \lib\app\form\form\search::list($q, $args);

		$filterBox     = \lib\app\form\form\search::filter_message();
		$isFiltered    = \lib\app\form\form\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

	}

}
?>
