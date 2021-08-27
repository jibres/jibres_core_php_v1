<?php
namespace content\ip\me;

class controller
{
	public static function routing()
	{
		\dash\code::jsonBoom(\dash\server::ip(), 'text');
	}
}
?>