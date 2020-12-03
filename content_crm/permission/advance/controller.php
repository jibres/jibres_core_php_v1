<?php
namespace content_crm\permission\advance;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmPermissionManagement');

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


		\dash\data::dataRow($dataRow);
	}
}
?>