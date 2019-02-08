<?php
namespace content_a\setting\maximum;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingEditPos');
	}
}
?>