<?php
namespace content_a\product\thumb;


class controller
{
	public static function routing()
	{
		if(!\dash\request::get('id'))
		{
			\dash\header::status(428);
		}
	}
}
?>
