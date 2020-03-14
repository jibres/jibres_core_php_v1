<?php
namespace content_crm\log\caller;


class view
{
	public static function config()
	{
		$myTitle = T_("Log");
		$myDesc  = T_('Check list of log and search or filter in them to find your logs.');


		\dash\data::page_title($myTitle);
		\dash\data::page_desc($myDesc);



		$dataTable = \dash\db\logs::get_caller_group();
		\dash\data::dataTable($dataTable);
	}
}
?>