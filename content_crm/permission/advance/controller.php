<?php
namespace content_crm\permission\advance;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');

		$dataRow = \dash\app\permission\get::get($id);

		if(!$dataRow)
		{
			\dash\header::status(404);
		}

		$group = \dash\request::get('group');


		$permissionList = \dash\permission::categorize_list();
		\dash\data::permissionList($permissionList);

		if(isset($permissionList[$group]))
		{
			\dash\data::advancePerm($permissionList[$group]);
		}
		else
		{
			\dash\header::status(404);
		}

		\dash\permission::access('cpPermissionAdd');

		\dash\data::dataRow($dataRow);
	}
}
?>