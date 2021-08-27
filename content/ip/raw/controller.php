<?php
namespace content\ip\raw;

class controller
{
	public static function routing()
	{
		\dash\code::jsonBoom(\dash\server::ip(), 'text');
	}
}
?>