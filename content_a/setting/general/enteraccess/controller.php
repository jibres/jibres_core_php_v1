<?php
namespace content_a\setting\general\enteraccess;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingEdit');

	}
}
?>