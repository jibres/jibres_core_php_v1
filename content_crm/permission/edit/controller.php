<?php
namespace content_crm\permission\edit;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmPermissionManagement');

		$id = \dash\request::get('id');

		$dataRow = \dash\app\permission\get::get($id, true);

		if(!$dataRow)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($dataRow);
	}
}
?>