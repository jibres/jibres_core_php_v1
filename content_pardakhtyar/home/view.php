<?php
namespace content_pardakhtyar\home;

class view
{
	public static function config()
	{
		if(\dash\request::get('transfer'))
		{
			\lib\pardakhtyar\app\shaparak\transfer::run();
		}
	}
}
?>