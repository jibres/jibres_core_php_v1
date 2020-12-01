<?php
namespace content_crm\member\business;


class controller
{
	public static function routing()
	{
		if(\dash\engine\store::inStore())
		{
			\dash\header::status(404, ';)');
		}
		\dash\permission::access('cpUsersEdit');
	}
}
?>