<?php
namespace content_crm\member\log;


class controller
{
	public static function routing()
	{
		\dash\permission::access('cpUsersEdit');
	}
}
?>