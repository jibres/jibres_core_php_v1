<?php
namespace content_a\cart\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Cart'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$dataTable = \lib\app\cart\search::detail(\dash\request::get('user'));

		\dash\data::dataTable($dataTable);

	}
}
?>
