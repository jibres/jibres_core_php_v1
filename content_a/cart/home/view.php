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

		$dataTable = \lib\app\cart\search::list();

		\dash\data::dataTable($dataTable);

	}
}
?>
