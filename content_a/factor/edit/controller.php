<?php
namespace content_a\factor\edit;


class controller
{
	public static function routing()
	{
		\dash\permission::access('factorEditAccess');
		if(!\dash\request::get('id'))
		{
			\dash\header::status(404, T_("Id not found"));
		}
	}
}
?>
