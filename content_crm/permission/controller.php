<?php
namespace content_crm\permission;

class controller
{

	public static function routing()
	{
		\dash\permission::access('crmPermissionManagement');
	}
}
?>