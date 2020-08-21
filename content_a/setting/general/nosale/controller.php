<?php
namespace content_a\setting\general\nosale;

class controller
{
	public static function routing()
	{

		\dash\permission::access('settingEdit');

	}
}
?>