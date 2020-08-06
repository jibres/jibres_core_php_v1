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


		$dataTable = \lib\app\tax\coding\search::list(null, []);
		\dash\data::dataTable($dataTable);

	}
}
?>
