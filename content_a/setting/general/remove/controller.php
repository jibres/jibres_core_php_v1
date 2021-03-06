<?php
namespace content_a\setting\general\remove;

class controller
{
	public static function routing()
	{

		\dash\permission::access('settingEdit');

		\dash\csrf::set();

	}
}
?>