<?php
namespace content_test1\home;

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