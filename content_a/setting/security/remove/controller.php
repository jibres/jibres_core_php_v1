<?php
namespace content_a\setting\security\remove;

class controller
{
	public static function routing()
	{

		\dash\permission::access('settingEdit');

	}
}
?>