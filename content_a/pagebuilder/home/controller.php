<?php
namespace content_a\pagebuilder\home;


class controller
{
	public static function routing()
	{
		$child    = \dash\url::child();

		if($child)
		{
			\lib\app\pagebuilder\line\design::route();
		}
	}
}
?>
