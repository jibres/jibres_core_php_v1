<?php
namespace content_a\cart\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Cart'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		// action
		\dash\data::action_text(T_('Add new cart'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::this(). '/add');

		$args = [];
		$q = \dash\request::get('q');

		$dataTable = \lib\app\cart\search::list($q, $args);



		$filterBox     = \lib\app\cart\search::filter_message();
		$isFiltered    = \lib\app\cart\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

		\dash\data::myData(\lib\app\cart\dashboard::admin());

	}
}
?>
