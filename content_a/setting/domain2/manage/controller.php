<?php
namespace content_a\setting\domain2\manage;

class controller
{
	public static function routing()
	{
		$domain = \dash\request::get('domain');
		if(!$domain)
		{
			\dash\header::status(404);
		}

	}
}
?>