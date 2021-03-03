<?php
namespace content_my\business\creating;


class controller
{
	public static function routing()
	{
		\content_my\business\creating::access_step('creating');

		\dash\csrf::set();
	}
}
?>
