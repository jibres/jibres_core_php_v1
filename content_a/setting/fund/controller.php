<?php
namespace content_a\setting\fund;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingEditPos');
	}
}
?>