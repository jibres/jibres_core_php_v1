<?php
namespace content\ip\home;

class controller
{
	public static function routing()
	{
		if(\dash\url::child())
		{
			\dash\open::get();
		}
	}
}
?>