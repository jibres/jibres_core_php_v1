<?php
namespace content_a\accounting\config;

class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_setting');

	}
}
?>