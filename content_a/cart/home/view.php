<?php
namespace content_a\cart\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Cart'));

		// back
		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::here());

		$dataTable = \lib\app\cart\search::list();

		\dash\data::dataTable($dataTable);

	}
}
?>
