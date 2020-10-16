<?php
namespace content_love\business\analytics\table;


class controller
{
	public static function routing()
	{
		$f = \dash\request::get('f');
		if(!$f)
		{
			\dash\header::status(404);
		}
	}
}
?>
