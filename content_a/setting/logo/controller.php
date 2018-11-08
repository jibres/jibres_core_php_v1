<?php
namespace content_a\setting\logo;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingEditLogo');
	}
}
?>