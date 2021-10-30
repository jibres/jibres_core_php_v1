<?php
namespace content_crm\log\notif;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Notif logs"));

		// btn
		\dash\data::back_text(T_('CRM'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(false);


		$args = [];

		$q = \dash\validate::search_string();

		$dataTable = \dash\app\log_notif\search::list($q, $args);

		$filterBox     = \dash\app\log_notif\search::filter_message();
		$isFiltered    = \dash\app\log_notif\search::is_filtered();


		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

	}

}
?>