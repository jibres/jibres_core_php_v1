<?php
namespace content_a\setting\factor;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingEditFactor');
	}
}
?>