<?php
namespace content_a\pay;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('id'))
		{
			\dash\header::status(404, T_("Id not found"));
		}
	}
}
?>
