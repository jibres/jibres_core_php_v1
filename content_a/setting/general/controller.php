<?php
namespace content_a\setting\general;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingEdit');

	}
}
?>