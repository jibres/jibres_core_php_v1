<?php
namespace content_my\business\ask;


class controller
{
	public static function routing()
	{
		\content_my\business\creating::access_step('ask');

		\dash\csrf::set();
	}
}
?>
