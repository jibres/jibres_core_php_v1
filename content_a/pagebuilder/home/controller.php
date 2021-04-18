<?php
namespace content_a\pagebuilder\home;


class controller
{
	public static function routing()
	{
		$child    = \dash\url::child();

		if($child)
		{
			\lib\pagebuilder\line\design::route();
		}
	}
}
?>