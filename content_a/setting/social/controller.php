<?php
namespace content_a\setting\social;

class controller
{
	public static function routing()
	{
		\dash\permission::access('settingEditSocialNetwork');
	}
}
?>