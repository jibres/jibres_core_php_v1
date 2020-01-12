<?php
namespace content_a\cart\view;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Cart'));

		// back
		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::this());

		$dataTable = \lib\app\cart\search::detail(\dash\request::get('user'));

		\dash\data::dataTable($dataTable);

	}
}
?>
