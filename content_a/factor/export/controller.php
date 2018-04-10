<?php
namespace content_a\factor\export;


class controller
{
	public static function ready()
	{
		if(!\dash\request::get('id'))
		{
			\dash\header::status(404, T_("Id not found"));
		}
	}
}
?>
