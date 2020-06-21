<?php
namespace content_a\setting\legal;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingView');

	}
}
?>