<?php
namespace content_a\form\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Form Builder'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::kingdom()."/crm");

				// back
		\dash\data::action_text(T_('Add new Form'));
		\dash\data::action_link(\dash\url::this(). '/add');



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
