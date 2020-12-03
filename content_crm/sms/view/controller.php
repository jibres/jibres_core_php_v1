<?php
namespace content_crm\staff;


class controller
{
	public static function routing()
	{
		\dash\permission::access('crmPermissionManagement');
	}
}
?>