<?php
namespace content_a\setting\shipping\setting;


class controller
{
	public static function routing()
	{
		\lib\app\setting\setup::ready(\dash\url::child());
	}
}
?>
