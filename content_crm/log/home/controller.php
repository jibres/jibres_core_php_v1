<?php
namespace content_crm\log\home;

class controller
{

	public static function routing()
	{
		\dash\permission::access('crmLog');
	}
}
?>