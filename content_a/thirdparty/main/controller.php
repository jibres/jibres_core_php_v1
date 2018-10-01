<?php
namespace content_a\thirdparty\main;


class controller
{
	public static function routing()
	{
		if(\dash\request::get('type') && !in_array(mb_strtolower(\dash\request::get('type')), ['supplier', 'staff', 'customer']))
		{
			\dash\header::status(400, T_("Invalid member type"));
		}
	}
}
?>