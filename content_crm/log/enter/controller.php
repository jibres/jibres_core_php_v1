<?php
namespace content_crm\log\enter;

class controller
{

	public static function routing()
	{
		\dash\permission::access('crmLog');
	}
}
?>