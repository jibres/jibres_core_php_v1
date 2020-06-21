<?php
namespace content_a\setting\home;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingView');

	}
}
?>