<?php
namespace content_a\app\android\apk;

class model
{
	public static function post()
	{
		\dash\notif::info("rebuild");
		\lib\app\application\queue::rebuild();
	}
}
?>
