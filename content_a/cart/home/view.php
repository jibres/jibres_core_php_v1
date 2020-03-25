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

		$dataTable = \lib\app\cart\search::list();

		\dash\data::dataTable($dataTable);

	}
}
?>
