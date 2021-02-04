<?php
namespace content_crm\notification\home;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_crm');
	}
}
?>
