<?php
namespace content_crm\permission\setting;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');

		$dataRow = \dash\app\permission\get::get($id, true);

		if(!$dataRow)
		{
			\dash\header::status(404);
		}


		\dash\permission::access('cpPermissionAdd');

		\dash\data::dataRow($dataRow);
	}
}
?>