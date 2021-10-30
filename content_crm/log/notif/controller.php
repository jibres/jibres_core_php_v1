<?php
namespace content_crm\log\notif;

class controller
{

	public static function routing()
	{
		\dash\permission::access('crmLog');
	}
}
?>