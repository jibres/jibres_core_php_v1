<?php
namespace content_a\app\android\apk;

class model
{
	public static function post()
	{
		if(\dash\request::post('build') === 'now')
		{
			\lib\app\application\queue::set_android();
			\dash\redirect::pwd();
		}
		// \lib\app\application\queue::rebuild();
	}
}
?>
