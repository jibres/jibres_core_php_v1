<?php
namespace content_a\notiflog;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Notif log'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());



		$args = [];

		$q = \dash\request::get('q');

		$dataTable = \dash\app\log_notif\search::list($q, $args);

		$filterBox     = \dash\app\log_notif\search::filter_message();
		$isFiltered    = \dash\app\log_notif\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);

		$show_group_by = \dash\app\log_notif\search::group_by();
		\dash\data::messgeGroupBy($show_group_by);


		\dash\data::dataTable($dataTable);

	}

}
?>
