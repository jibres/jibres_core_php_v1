<?php
namespace content_a\setting\general\lang;

class controller
{
	public static function routing()
	{
		\dash\csrf::set();

		\dash\permission::access('settingEdit');

	}
}
?>