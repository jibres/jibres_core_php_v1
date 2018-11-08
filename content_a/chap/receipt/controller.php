<?php
namespace content_a\chap\receipt;


class controller
{
	public static function routing()
	{
		\dash\permission::access('factorAccess');

		if(!\dash\request::get('id'))
		{
			\dash\header::status(404, T_("Id not found"));
		}
	}
}
?>
