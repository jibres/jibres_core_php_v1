<?php
namespace content_hook\address;

class controller
{
	public static function routing()
	{
		if(\dash\url::child() === null)
		{
			\dash\code::jsonBoom(['url' => \dash\url::all(), 'server' => $_SERVER]);
		}

	}
}
?>