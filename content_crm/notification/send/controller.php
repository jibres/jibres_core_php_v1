<?php
namespace content_crm\notification\send;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_crm');
	}
}
?>
