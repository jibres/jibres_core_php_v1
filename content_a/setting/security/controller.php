<?php
namespace content_a\setting\security;

class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_setting');

	}
}
?>