<?php
namespace content_a\product\delete;


class controller
{
	public static function routing()
	{
		\dash\permission::access('aProductDelete');
		if(!\dash\request::get('id'))
		{
			\dash\header::status(428);
		}
	}
}
?>
