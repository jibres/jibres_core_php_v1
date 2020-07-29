<?php
namespace content_crm\log\caller;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Log"));

		$dataTable = \dash\db\logs::get_caller_group();
		\dash\data::dataTable($dataTable);
	}
}
?>