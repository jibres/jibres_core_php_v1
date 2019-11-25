<?php
namespace content_a\setup\scale;


class controller
{
	public static function routing()
	{
		\lib\app\setting\setup::ready(\dash\url::child());
	}
}
?>
