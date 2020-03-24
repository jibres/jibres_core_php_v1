<?php
namespace content_crm\log\show;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Log"));

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