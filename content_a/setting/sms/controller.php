<?php
namespace content_a\setting\sms;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingEditFactor');
	}
}
?>