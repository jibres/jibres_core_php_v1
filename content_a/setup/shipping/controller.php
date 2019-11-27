<?php
namespace content_a\setup\shipping;


class controller
{
	public static function routing()
	{
		\lib\app\setting\setup::ready(\dash\url::child());
	}
}
?>
