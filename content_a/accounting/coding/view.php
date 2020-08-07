<?php
namespace content_a\accounting\coding;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Accounting Coding'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		// back
		\dash\data::action_text(T_('Add coding'));
		\dash\data::action_link(\dash\url::that(). '/add');


		$args = [];
		$q = \dash\request::get('q');

		$dataTable = \lib\app\tax\coding\search::list($q, $args);




		$filterBox     = \lib\app\tax\coding\search::filter_message();
		$isFiltered    = \lib\app\tax\coding\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

	}
}
?>
