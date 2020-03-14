<?php
namespace content_crm\log\show;


class view
{
	public static function config()
	{
		$myTitle = T_("Log");
		$myDesc  = T_('Check list of log and search or filter in them to find your logs.');


		\dash\data::page_title($myTitle);
		\dash\data::page_desc($myDesc);



		$log_id = \dash\request::get('id');

		if(!$log_id || !is_numeric($log_id))
		{
			\dash\header::status(404);
		}

		$dataRow = \dash\db\logs::get(['id' => $log_id, 'limit' => 1]);
		\dash\data::dataRow($dataRow);

	}
}
?>