<?php
namespace content_crm\log;

class controller
{

	public static function routing()
	{
		\dash\permission::access('crmLog');
	}
}
?>