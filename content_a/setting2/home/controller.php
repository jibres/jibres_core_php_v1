<?php
namespace content_a\setting2\home;

class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_setting');

	}
}
?>