<?php
namespace content_crm\permission\add;

class controller
{

	public static function routing()
	{
		\dash\permission::access('crmPermissionManagement');
	}
}
?>