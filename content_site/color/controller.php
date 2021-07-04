<?php
namespace content_site\color;


class controller
{
	public static function routing()
	{
		if(\dash\request::get('json'))
		{
			$list = color::list();
			\dash\code::jsonBoom($list);
		}
	}
}
?>