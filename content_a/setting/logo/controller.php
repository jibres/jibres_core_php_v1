<?php
namespace content_a\setting\logo;


class controller
{
	public static function routing()
	{
		\lib\app\setting\setup::ready(\dash\url::child());

		\dash\allow::file();
	}
}
?>
