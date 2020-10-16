<?php
namespace content_love\business\analytics\table;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Store analytics"));

				// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		$args =
		[
			'f' => \dash\request::get('f'),
		];

		$dataTable = \lib\app\store\search::list_analytics(null, $args);

		\dash\data::dataTable($dataTable);

	}
}
?>
