<?php
namespace content_a\android\home;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_setting');
	}
}
?>
