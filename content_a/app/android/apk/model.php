<?php
namespace content_a\app\android\apk;

class model
{
	public static function post()
	{

		\lib\app\application\queue::set_android();
		// \lib\app\application\queue::rebuild();
	}
}
?>
